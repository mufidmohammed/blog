<?php

$postid = $_GET['id'];

$msg = $_POST['msg'];

$sql = "INSERT INTO `comments`(`msg`, `postid`) VALUES ('$msg', '$postid')";

// if user bypass client side validation and submit an
// empty comment, return to homepage
if (! $msg) {
    header("location: public/index.php");
}

if (! $conn -> query($sql)) {
    die("An unexpected error occured : " . $conn->error);
} else {
    header("location: show_comments.php?id=$postid");
}
