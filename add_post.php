<?php

require_once 'db_connect/connect.php';

session_start();

$userid = $_SESSION['userid'];

if (isset($_POST["submit"])) {
    
    $msg = $_POST['msg'];

    $sql = "INSERT INTO `posts` (`msg`, `userid`) VALUES ('$msg', '$userid') ";

    if (! $conn -> query($sql) )
    {
        die("Could not update record : " . $conn->error);

    } else {
        header("location: blog.php");
    }
}

$conn -> close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Create a new post</title>
  <link rel="stylesheet" type="text/css" href="static/w3.css" >
</head>
<body>
  <div class="w3-container w3-margin-top">
    <div class="w3-btn w3-light-grey"><a href="blog.php">Back</a></div>
  </div>
  <div class="w3-content w3-center" style="max-width: 700px">
    <div class="w3-container">
      <h2>Create a new post</h2>
      <form action="add_post.php" method="POST">
        <div class="w3-container w3-margin-bottom">
          <input type="text" class="w3-input w3-border" placeholder="Enter title..." style="width:100%" name="title" required >
        </div>
        <div class="w3-container">
          <textarea name="msg" cols="70" rows="10" placeholder="Enter text here..." required ></textarea>
        </div>
        <div class="w3-container" style="max-width: 100px">
          <input type="submit" class="w3-input" name="submit" value="submit">
        </div>
      </form>
    </div>
  </div>
</body>