<?php

require_once 'db_connect/connect.php';

session_start();

if (! isset($_SESSION['userid'])) {
	header('location: login.php');
}

$userid = $_SESSION['userid'];

$image_error = '';

if (isset($_POST["submit"])) {

  $title = $conn -> real_esacape_string($_POST['title']);
  
  $msg = $conn -> real_escape_string($_POST['msg']);

  // get id of last post 
  // $last_id = $conn -> insert_id + 1;

  $target_dir = __DIR__ . '/images/';

  $file_extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

  $is_image = getimagesize($_FILES['image']['tmp_name']);

  $file_ok = false;

  if ($is_image === false)
  {
    $image_error = 'Please choose an actual image';      
  } else {
    // check if image is greather than 500KB
    if ($_FILES['image']['size'] > 500000) {
      $image_error = 'File size too large';
    } else {
      // move uploaded file to images directory
      // move_uploaded_file($uploaded_file_name, $final_file_name);
      $file_ok = true;
    }
  }

  if ($file_ok) {
    $sql = "INSERT INTO `posts` (`title`, `msg`, `userid`) VALUES ('$title', '$msg', '$userid')";

    if (! $conn -> query($sql) )
    {
        die("Could not update record : " . $conn->error);

    } else {
       
      $last_id = $conn -> insert_id;
      $uploaded_file_name = $_FILES['image']['tmp_name'];
      $final_file_name = $target_dir . "{$last_id}.{$file_extension}";

      if (! move_uploaded_file($uploaded_file_name, $final_file_name)) {
        die("Error uplaoding image. Only your message has been posted");
      }

      header("location: index.php");
    }
  }
  // else pass down to add_post.php and display errors
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
    <div class="w3-btn w3-light-grey"><a href="index.php">Back</a></div>
  </div>
  <div class="w3-content w3-center" style="max-width: 700px">
    <div class="w3-container">
      <h2>Create a new post</h2>
      <form action="add_post.php" method="POST" enctype="multipart/form-data">
        <div class="w3-container w3-margin-bottom">
          <input type="text" class="w3-input w3-border" placeholder="Enter title..." style="width:100%" name="title" required >
        </div>
        <div class="w3-container w3-margin-bottom">
          <textarea name="msg" cols="70" rows="10" placeholder="Enter text here..." required ></textarea>
        </div>
        <div class="w3-container w3-margin-bottom">
          <div class="w3-text w3-left">You can add a picture of your post here</div>
          <input type="file" class="w3-input w3-border" style="width:100%" name="image" >
          <small><?= $image_error ?></small>
        </div>
        <div class="w3-container" style="max-width: 100px">
          <input type="submit" class="w3-input" name="submit" value="submit">
        </div>
      </form>
    </div>
  </div>
</body>