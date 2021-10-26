<?php

require_once 'db_connect/connect.php';

session_start();

if (! isset($_SESSION['userid'])) {
	header('location: login.php');
}

$id = $_GET['comment_id'];
$userid = $_SESSION['userid'];

$sql = "DELETE FROM `comments` WHERE `userid`='$userid' AND `id`='$id'";

$query = $conn -> query($sql);

if ($conn -> connect_errno)
{
	die($conn -> error);
}

header("location: blog.php");
