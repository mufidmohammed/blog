<?php

session_start();

session_unset();  // erase all session data

session_destroy();  // destroy session

header('location: login.php');
