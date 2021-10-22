<?php

define("DB_USER", "root");
define("DB_PASS", "jerusalem1991");
define("DB_HOST", "localhost");
define("DB_NAME", "logindb");

try {
    $dbcon = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    mysqli_set_charset($dbcon, 'utf8');
} catch (Exception $e) {
    //echo "An Exception occured, Message: <br>" . $e->getMessage();
    echo 'System busy, try again later';
} catch (Error $e) {
    //echo "An Exception occured, Message: <br>" . $e->getMessage();
    echo 'System busy, try again later';
}
