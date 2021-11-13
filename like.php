<?php

require_once 'db_connect/connect.php';

session_start();

$userid = $_SESSION['userid'];

if (isset($_POST['commentID']))
{
  $referenceID = $_POST['commentID'];
  $table = 'comments';
} else {
  $referenceID = $_POST['postid'];
  $table = 'posts';
}

$sql = "SELECT `id` FROM `likes` WHERE `referenceID` ='$referenceID' AND `userid`='$userid'";

$query = $conn -> query($sql);

if (! $query) {
  die("Error connecting to database. " . $conn -> error);
}

$result = $query -> fetch_assoc();

// if id is in likes table
// means user has already voted before and is unvoting
if ($result)
{
  $id = $result['id'];
  // delete row from database
  $conn -> query("DELETE FROM `likes` WHERE `id` = '$id'");
  // subtract 1 from the database
  $conn -> query("UPDATE $table SET `likes` = `likes` - 1 WHERE `id` = '$referenceID'");

} else {
  // user have not voted before
  $conn -> query("INSERT INTO `likes` (`referenceID`, `userid`) VALUES ('$referenceID', '$userid')");

  if ($conn -> errno) {
    die($conn -> error);
  }

  $conn -> query("UPDATE $table SET `likes` = `likes` + 1 WHERE `id` = '$referenceID'");
}

// redirecting to the right page
if (isset($_POST['commentID']))
{
  $postid = $_POST['postid'];
  $location = "show_comments.php?id={$postid}";
} else {
  $location = 'index.php';
}

header("location: {$location}");
