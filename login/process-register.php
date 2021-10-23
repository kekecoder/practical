<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        // initialise errors in array
        $errors = [];
        // validating users input
        // checking if the  fields are empty
        $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
        if (empty($first_name)) {
            $errors[] = "You forgot to enter your first name";
        }

        $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
        if (empty($last_name)) {
            $errors[] = "You forgot to enter you last name";
        }

        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        if ((empty($email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
            $errors[] = "You forgot to enter your email address";
            $errors[] = "You entered invalid email address";
        }

        $password1 = filter_var($_POST['password1'], FILTER_SANITIZE_STRING);
        $password2 = filter_var($_POST['password2'], FILTER_SANITIZE_STRING);

        if (!empty($password1)) {
            if ($password1 !== $password2) {
                $errors[] = "Your password do not match";
            }
        } else {
            $errors[] = "You forgot to enter your password";
        }

        // if everything is ok
        // hash the password
        // insert the records into the database
        if (empty($errors)) {
            $hashed_password = password_hash($password1, PASSWORD_DEFAULT);

            // pulling in the database connection
            require_once "mysqli_connect.php";

            // Inserting the records
            $query = "INSERT INTO users(user_id, first_name, last_name, email, password, registration_date)";
            $query .= "VALUES(0, ?, ?, ?, ?, NOW())";

            // initialize the database connection
            $q = mysqli_stmt_init($dbcon);
            mysqli_stmt_prepare($q, $query);

            // Prepared statement
            mysqli_stmt_bind_param($q, 'ssss', $first_name, $last_name, $email, $hashed_password);

            // execute the program
            mysqli_stmt_execute($q);

            if (mysqli_stmt_affected_rows($q) == 1) {
                header("location: register-thanks.php");
                exit();
            } else {
                $errorstring = "<p class='text-center col-sm-8' style = 'color:red'>";
                $errorstring .= "System Error <br> You could not be registered due ";
                $errorstring .= "to a system error. We appologize for any inconvinience. </p>";
                echo "<p class=' text-center col-sm-2' style='color:red'>$errorstring</p>";

                // Debugging code
                echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $query . '</p>';
                mysqli_close($dbcon);
                // include footer then close the program to stop executing
                echo '<footer class="jumbotron text-center col-sm-12" style="padding-bottom:1px; padding-top:8px;>
          include("footer.php");
          </footer>';
                exit();
            }

        } else {
            $errorstring = "Error! The following error(s) occurred:<br>";
            foreach ($errors as $msg) {
                $errorstring .= " - $msg <br> \n";
            }
            $errorstring .= "Please try again.<br>";
            echo "<p class=' text-center col-sm-2' style='color:red'>$errorstring</p>";
        }
    } catch (Exception $e) {
        // Debug code
        // print "An Exception occurred. Message " . $e->getMessage() . "<br>";
        print "The system is busy, try again later";
    } catch (Error $e) {
        // Debug code
        // print "An Error occurred. Message " . $e->getMessage() . "<br>";
        print "The system is busy, try again later";
    }

} else {
    print('Wrong gateway');
}
