<?php

require_once 'db_connect/connect.php';
require_once 'app.php';

session_start();

if (! isset($_SESSION['userid'])) {
	header('location: login.php');
}

$postid = $_POST['postid'];

$userid = $_SESSION['userid'];

// if empty comment, return to comment section
if (! $_POST['comment']) {
    header("location: show_comments.php?id={$postid}");
}

$comment = $conn -> real_escape_string($_POST['comment']);

$sql = "INSERT INTO `comments`(`msg`, `likes`, `postid`, `userid`) VALUES ('$comment', '0', '$postid', '$userid')";

$query = $conn -> query($sql);

if ($conn->errno) {
    die("An unexpected error occured : " . $conn->error);
} else {
    header("location: show_comments.php?id={$postid}");
}
