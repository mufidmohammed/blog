<?php

require_once 'db_connect/connect.php';
require_once 'app.php';

$postid = $_POST['postid'];

$userid = get_user_by_postid($postid, $conn);

$comment = $_POST['comment'];

$sql = "INSERT INTO `comments`(`msg`, `postid`, `userid`) VALUES ('$comment', '$postid', '$userid')";

// if empty comment, return to comment section
if (! $comment) {
    header("location: show_comments.php?id={$postid}");
}

if (! $conn -> query($sql)) {
    die("An unexpected error occured : " . $conn->error);
} else {
    header("location: show_comments.php?id={$postid}");
}
