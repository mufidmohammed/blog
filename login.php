<?php

require_once 'db_connect/connect.php';

session_start();

$error = '';

if (isset($_POST['login']))
{
    $username = htmlspecialchars($_POST['username']);
    
    $password = htmlspecialchars($_POST['password']);

    $sql = "SELECT `id` FROM `users` WHERE `username`='$username' AND `password`='$password'";

    $query = $conn -> query($sql);

    $user = $query->fetch_assoc();

    if (isset($user['id'])) {
        $_SESSION['userid'] = $user['id'];
        header("location: blog.php");
    } else {
      $error = 'Username or password incorrect';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Login page </title>
<link rel="stylesheet" type="text/css" href="static/w3.css" >
</head>
<body>
<div style="margin:50px;"></div>
  <div class="w3-content" style="max-width:50%;">
    <div class="w3-container w3-teal w3-margin">
      <h2 class="w3-center">Welcome</h2>
    </div>
    <form action="login.php" method="post" class="w3-container">
      <div class="w3-row">
        <label class="w3-text-teal"><b>Username</b></label>
        <input type="text" name="username" class="w3-input w3-border w3-light-grey" required >
      </div>
      <div class="w3-row">
        <label class="w3-text-teal"><b>Password</b></label>
        <input type="password" name="password" class="w3-input w3-border w3-light-grey" required >
      </div>
      <div><small class="w3-text-red"><?= $error; ?></small></div>
      <div class="w3-row">
        <input type="submit" class="w3-input w3-teal" name="login" value="login">
      </div>
    </form>
  </div>
</body>
