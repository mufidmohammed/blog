<?php

require_once 'db_connect/connect.php';

session_start();

if (! isset($_SESSION['userid'])) {
	header('location: login.php');
}

$userid = (int)$_SESSION['userid'];

$id = (int)$_GET['postid'];

$conn -> query("DELETE FROM `comments` WHERE `postid`='$id'");

if ($conn -> connect_errno) {
	die('Error deleting comment : ' . $conn->connect_error);
}

$conn -> query("DELETE FROM `posts` WHERE `id`='$id'");

if ($conn->connect_errno)
{
	die('Error deleting post : ' . $conn -> error);
}

header("location: index.php");
