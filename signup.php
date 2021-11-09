<?php

require_once 'db_connect/connect.php';

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);

  return $data;
}

$error = ['firstName'=>'', 'lastName'=>'', 'middleName'=>'', 'username'=>'', 'email'=>'', 'password'=>''];

if (isset($_POST['signup']))
{

  $firstName = test_input($_POST['firstName']);

  if (!preg_match("/^[a-zA-Z-' ]*$/", $firstName)) {
    $error['firstName'] = "Please enter your first name";
    $firstName = "";
  } else {
    $error['firstName'] = '';
  }

  $lastName = test_input($_POST['lastName']);
  if (!preg_match("/^[a-zA-Z-' ]*$/", $lastName)) {
    $error['lastName'] = "Please enter a valid name";
    $lastName = '';
  } else {
    $error['lastName'] = '';
  }

  $middleName = test_input($_POST['middleName']) ?? '';
  if ($middleName) {
    if (!preg_match("/^[a-zA-Z-' ]*$/", $middleName)) {
      $error['middleName'] = "Please enter a valid name";
      $middleName = '';
    } else {
      $error['middleName'] = '';
    }
  } else {
    $error['middleName'] = '';
  }

  $username = test_input($_POST['username']);

  $sql = "SELECT `username` FROM `users` WHERE 1";
  $query = $conn -> query($sql);
  
  while ($user_info = $query -> fetch_assoc()) {
    if ($username === $user_info['username']) {
      $error['username'] = 'Username already exist';
      $username = '';
      break;
    }
  }
  
  if (!preg_match("/^[a-zA-Z-']*$/", $username)) {
    $error['username'] = "Please enter a valid username";
    $username = '';
  } else {
    $error['username'] = '';
  }

  $email = test_input($_POST['email']);
  if (!FILTER_VAR($email, FILTER_VALIDATE_EMAIL)) {
    $error['email'] = "Please enter a valid email";
    $email = '';
  } else {
    $error['email'] = '';
  }

  $password_1 = test_input($_POST['password_1']);
  $password_2 = test_input($_POST['password_2']);
  if ($password_1 !== $password_2) {
    $error['password'] = 'Passwords don\'t much';
    $password_1 = $password_2 = '';
  }
  elseif (strlen($password_1) < 8) {
    $error['password'] = "Password must contain atleast 8 characters";
    $password_1 = $password_2 = '';
  }
  elseif (!preg_match("/^(?=.*[a=z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $password_1)) {
    $error['password'] = "Password must contain a capital letter, small letter and a digit";
    $password_1 = $password_2 = '';
  }
  else {
    $error['password'] = '';
    $password = password_hash($password_1, PASSWORD_DEFAULT);
  }

  $about = (!empty($_POST['about'])) ? test_input($_POST['about']) : '';

  // checking for errors
  $has_errors = false;
  foreach($error as $err) {
    if ($err) {
      $has_errors = true;
      break;
    }
  }

  // if no errors, insert into database
  if ($has_errors == false) {
    $sql = "INSERT INTO `users` 
      (`firstName`, `lastName`, `middleName`, `username`, `email`, `password`, `about`) VALUES 
      ('$firstName', '$lastName', '$middleName', '$username', '$email', '$password', '$about')";

    if ($conn -> query($sql)) {
      header('location: signup_success.php');
    } else {
      die($conn -> error);
    }
  }
}

?>
<html>
<head>
<title>Sign up</title>
  <link rel="stylesheet" type="text/css" href="static/w3.css" >
</head>
<body>
  <div style="margin:50px;"></div>
  <div class="w3-content" style="max-width:50%">
    <div class="container w3-teal w3-padding">
      <h2>Sign Up</h2>
    </div>
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
      <div class="w3-row">
        <label><b>First name</b></label>
        <input type="text" name="firstName" class="w3-input w3-border w3-light-grey" placeholder="First name" required>
        <small class="w3-text-danger"> <?= $error['firstName']; ?> </small>
      </div>

      <div class="w3-row">
        <label><b>Last name</b></label>
        <input type="text" class="w3-input w3-light-grey" name="lastName" placeholder="Last name" required>
        <small class="w3-text-danger"> <?= $error['lastName'] ?> </small>
      </div>

      <div class="w3-row">
        <label><b>Middle name</b></label>
        <input type="text" name="middleName" placeholder="Middle name" class="w3-input w3-light-grey" >
        <small class="w3-text-danger"> <?= $error['middleName'] ?> </small>
      </div>

      <div class="w3-row">
      <label><b>Username</b></label>
      <input type="text" name="username" placeholder="Username" class="w3-input w3-light-grey" required>
      <small class="w3-text-danger"> <?= $error['username'] ?> </small>
      </div>

      <div class="w3-row">
        <label><b>Email</b></label>
        <input type="text" name="email" placeholder="Enter Email" class="w3-input w3-light-grey" required>
        <small class="w3-text-danger"> <?= $error['email'] ?> </small>
      </div>

      <div class="w3-row">
        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" class="w3-input w3-light-grey" name="password_1" required>
      </div>

      <div class="w3-row">
        <label><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="password_2" class="w3-input w3-light-grey" required>
        <small class="w3-text-danger"> <?= $error['password'] ?> </small>
      </div>

      <div class="w3-row">
        <label><b>About</b></label>
        <textarea name="about" cols="40" rows="10" placeholder="Write something about yourself"></textarea>
      </div>

      <div class="w3-row">
        <div class="clearfix">
          <button type="submit" class="w3-input w3-teal" name="signup" value="signup">Sign Up</button>
        </div>
      </div>

    </div>
  </form>

  </div>
</body>
</html>