<?php

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        // Validate users input
        // check if users email is empty and also check if wrong email format is input
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        if ((empty($email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
            $errors[] = "You forgot to enter your email address";
            $errors[] = " or you entered an invalid email address";
        }

        // validate password
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        if (empty($password)) {
            $errors[] = "You forgot to enter your password";
        }

        // If no errors was found
        if (empty($errors)) {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); # reporting actual erorr
            require 'mysqli_connect.php';
            // retrieve the user_id, password, first_name and user_level for that email/password combination
            $query = "SELECT user_id, password, first_name, user_level FROM users WHERE email=?";
            $q = mysqli_stmt_init($dbcon);
            mysqli_stmt_prepare($q, $query);

            // bind $id to SQL statement
            mysqli_stmt_bind_param($q, "s", $email);

            // execute the query
            mysqli_stmt_execute($q);

            // get the result from the database
            $result = mysqli_stmt_get_result($q);
            $row = mysqli_fetch_array($result, MYSQLI_NUM);

            // if one database row matches the input
            if (mysqli_num_rows($result) == 1) {
                // start the session, fetch the record and insert the row inside an array
                if (password_verify($password, $row[1])) {
                    session_start();

                    // Ensure the user level is an integer
                    $_SESSION['user_level'] = (int) $row[3];
                    $_SESSION['first_name'] = (int) $row[2];

                    // use ternary operator to set the url
                    $url = ($_SESSION['user_level'] === 1) ? 'admin-page.php' : 'members-page.php';
                    header('Location: ' . $url);
                    exit();
                } else {
                    // no password match was made
                    $errors[] = 'E-mail/Password you entered does not match our records. ';
                    $errors[] = 'Perhaps you need to register, just click the Register ';
                    $errors[] = 'button on the header menu';
                }
            } else {
                $errors[] = 'E-mail/Password you entered does not match our records. ';
                $errors[] = 'Perhaps you need to register, just click the Register ';
                $errors[] = 'button on the header menu';
            }
        }
        if (!empty($errors)) {
            $errorstring = "Error! The following error(s) occurred:<br>";
            foreach ($errors as $msg) {
                $errorstring .= " - $msg <br> \n";
            }
            $errorstring .= "Please try again.<br>";
            echo "<p class=' text-center col-sm-2' style='color:red'>$errorstring</p>";
        }

        mysqli_stmt_free_result($q);
        mysqli_stmt_close($q);
    } catch (Exception $e) {
        // Debug code
        print "An Exception occurred. Message " . $e->getMessage() . "<br>";
        print "The system is busy, try again later";
    } catch (Error $e) {
        // Debug code
        print "An Error occurred. Message " . $e->getMessage() . "<br>";
        print "The system is busy, try again later";
    }
} else {
    print "Bad Gateway";
}
