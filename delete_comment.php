<?php

require_once 'db_connect/connect.php';

session_start();

if (! isset($_SESSION['userid'])) {
	header('location: login.php');
}

$commentID = $_GET['commentID'];
$postid = $_GET['postid'];

$userid = $_SESSION['userid'];

$sql = "DELETE FROM `comments` WHERE `userid`='$userid' AND `id`='$commentID'";

$conn -> query($sql);

header("location: show_comments.php?id={$postid}");
