<?php
define('DB_USER', 'root');
define('DB_PASSWORD', 'jerusalem1991');
define('DB_HOST', 'localhost');
define('DB_NAME', 'simpledb');

// connecting to the database
try {
    $dbcon = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    mysqli_set_charset($dbcon, 'utf8');
} catch (Exception $e) {
    //print "An Exception occurred. Message: " . $e->getMessage();
    print "The system is busy please try later";
} catch (Error $e) {
    print "An Error occurred. Message: " . $e->getMessage();
    print "The system is busy please try again later.";
}
