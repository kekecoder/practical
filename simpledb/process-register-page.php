<?php
$errors = [];

//$registration_date = date("Y-m-d H:i:s");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = trim($_POST['first_name']);
    if (empty($first_name)) {
        $errors[] = 'You forgot to enter your first name.';
    }

    $last_name = trim($_POST['last_name']);
    if (empty($last_name)) {
        $errors[] = 'You forgot to enter your last name.';
    }

    $email = trim($_POST['email']);
    if (empty($email)) {
        $errors = 'You forgot to enter your email address';
    }

    $password1 = trim($_POST['password1']);

    $password2 = trim($_POST['password2']);
    if (empty($password1)) {
        if ($password1 !== $password2) {
            $errors[] = "Your passwords does not match.";
        } else {
            $errors[] = 'You forgot to enter your password.';
        }
    }

    if (empty($errors)) {
        try {
            // register the user in the database
            // hash password current 60 characters but can increase
            $hashed_passcode = password_hash($password1, PASSWORD_DEFAULT);
            require 'mysqli_connect.php';

            //make a query
            $query = "INSERT INTO users (userid, first_name, last_name, email, password, registration_date) ";
            $query .= "VALUES(0, ?, ?, ?, ?, NOW() )";
            $q = mysqli_stmt_init($dbcon);
            mysqli_stmt_prepare($q, $query);
            mysqli_stmt_bind_param($q, 'ssss', $first_name, $last_name, $email, $hashed_passcode);
            mysqli_stmt_execute($q);

            if (mysqli_stmt_affected_rows($q) == 1) {
                header('location: register-thanks.php');
                exit();
            } else {
                $errorstring = "<p class='text-center col-sm-8' style='color:red'>";
                $errorstring .= "System Error<br />You could not be registered due ";
                $errorstring .= "to a system error. We apologize for any inconvenience.</p>";
                echo "<p class=' text-center col-sm-2' style='color:red'>$errorstring</p>";
                // Debugging message below do not use in production
                //echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $query . '</p>';
                mysqli_close($dbcon); // Close the database connection.
                // include footer then close program to stop execution
                echo '<footer class="jumbotron text-center col-sm-12"                                       style="padding-bottom:1px; padding-top:8px;">                               include("footer.php")          </footer>';exit();
            }
        } catch (Exception $e) {
            //print "An Exception occurred. Message " . $e->getMessage();
            print "The system is busy, try again later";
        }
    } else {
        $errorstring = "Error! The following error(s) occurred:<br>";
        foreach ($errors as $msg) {
            $errorstring .= " - $msg <br>";
        }
        $errorstring .= "Please try again.<br>";
        echo "<p class=' text-center col-sm-2' style='color:red'>$errorstring</p>";
    }
} else {
    echo 'Bad gateway';
}
