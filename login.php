<?php

require_once 'db_connect/connect.php';

session_start();

$error = '';

if (isset($_POST['login']))
{
    $username = $conn -> real_escape_string($_POST['username']);
    $password = $conn -> real_escape_string($_POST['password']);

    $sql = "SELECT `id`, `password` FROM `users` WHERE `username` = '$username'";
    $query = $conn -> query($sql);

    if ($query) {
      $user = $query -> fetch_assoc();
      
      if ($user && password_verify($password, $user['password'])) {
        $user_id = $user['id'];
      }
    }

    if (isset($user_id)) {
        $_SESSION['userid'] = $user_id;
        header("location: index.php");
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
      <br>
      <div class="w3-row">
        <input type="submit" class="w3-input w3-teal" name="login" value="login">
      </div>
      <br>
      <div>Don't have an account? <a href="signup.php" class="w3-link"><span class="w3-btn w3-teal">signup</span></a></div>
    </form>
    
  </div>
</body>
</html>