<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require_once 'mysqli_connect.php';
    $errors = [];

    $email = trim($_POST['email']);
    if (empty($email)) {
        $errors[] = 'You forgot to enter your email address.';
    }

    $password = trim($_POST['password']);
    if (empty($password)) {
        $errors[] = 'You forgot to enter your old password';
    }

    $new_password = trim($_POST['password1']);
    $verify_password = trim($_POST['password2']);

    if (empty($new_password)) {
        if (($new_password !== $verify_password) || ($password === $new_password)) {
            $errors[] = 'Your new password did not match the confirmed password and/or ';
            $errors[] = 'Your old password is the same as your new password';
        } else {
            $errors[] = 'You did not enter a new password';
        }
    }
    if (empty($errors)) {
        try {
            $query = "SELECT userid, password FROM users WHERE (email=?)";
            $q = mysqli_stmt_init($dbcon);
            mysqli_stmt_prepare($q, $query);
            mysqli_stmt_bind_param($q, 's', $email);
            mysqli_stmt_execute($q);
            $result = mysqli_stmt_get_result($q);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ((mysqli_num_rows($result) == 1) && (password_verify($password, $row['password']))) {
                $hashed_passcode = password_hash($new_password, PASSWORD_DEFAULT);
                $query = "UPDATE users SET password=? WHERE email=?";
                $q = mysqli_stmt_init($dbcon);
                mysqli_stmt_prepare($q, $query);
                mysqli_stmt_bind_param($q, 'ss', $hashed_passcode, $email);
                mysqli_stmt_execute($q);

                if (mysqli_stmt_affected_rows($q) == 1) {
                    header("Location: password-thanks.php");
                } else {
                    $errorstring = "System Error! <br> You could not change your password due ";
                    $errorstring .= "to a system error. We appologize for any inconvinience.";
                    echo "<p class='text-center col-sm-2' style='color:red;'>$errorstring</p>";

                    echo '<footer class="jumbotron text-center col-sm-12" style="padding-bottom:1px;"padding-top:8px";>
                        include("footer.php");
                    </footer>';
                    exit();
                }
            } else {
                $errorstring = 'Error <br> ';
                $errorstring .= 'The email address/or password do not match our record <br>';
                $errorstring .= ' Please try again.';

                echo "<p class='text-center col-sm-2' style='color:red'>$errorstring</p>";
            }
        } catch (Exception $e) {
            // print "An Exception occured. Message: " . $e->getMessage();
            print "The system is busy, please try again later";
        } catch (Error $e) {
            // print "An Error occured. Message: " . $e->getMessage();
            print "The system is busy, please try again later";
        }
    } else {
        //header("location: register-page.php");

        $errorstring = "Error! The following error(s) occured:<br> ";
        foreach ($errors as $error) {
            $errorstring .= "- $error<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        echo "<p class='text-center col-sm-2' style='color:red'>$errorstring</p>";
    }
} else {
    echo "Bad gateway";
}
