<?php

require_once 'db_connect/connect.php';

session_start();

if (! isset($_SESSION['userid']))
  header('location: logout.php');

$userid = $_SESSION['userid'];

if (isset($_GET['commentID']))
{
  $referenceID = $_GET['commentID'];
  $table = 'comments';
} else {
  $referenceID = $_GET['postid'];
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

// now get current number of likes
$query = $conn -> query("SELECT `likes` FROM $table WHERE `id` = '$referenceID'");
if ($conn -> errno) {
  die($conn -> error);
}

$result = $query -> fetch_assoc();

$likes = $result['likes'];

echo $likes;
