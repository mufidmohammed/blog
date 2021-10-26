<?php

require_once 'db_connect/connect.php';
require_once 'app.php';

session_start();

if (! isset($_SESSION['userid'])) {
	header('location: login.php');
}

$postid = $_POST['postid'];

$userid = $_SESSION['userid'];

$comment = $_POST['comment'];

$sql = "INSERT INTO `comments`(`msg`, `postid`, `userid`) VALUES ('$comment', '$postid', '$userid')";

// if empty comment, return to comment section
if (! $comment) {
    header("location: show_comments.php?id={$postid}");
}

$query = $conn -> query($sql);

if ($conn->connect_errno) {
    die("An unexpected error occured : " . $conn->error);
} else {
    header("location: show_comments.php?id={$postid}");
}
