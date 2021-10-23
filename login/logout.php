<?php
session_start();
// if no sesson variable is found, redirect the user to home page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
} else {
    $_SESSION = [];
    $params = session_get_cookie_params();
    Setcookie(session_name(), " ", time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );

    if (session_status() == PHP_SESSION_ACTIVE) {
        session_destroy();
    }
    header("Location: index.php");
}
