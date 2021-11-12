<?php

require_once 'db_connect/connect.php';

session_start();

session_unset();  // erase all session data

session_destroy();  // destroy session

// close database
$conn -> close();

header('location: login.php');
