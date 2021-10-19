<?php

if (isset($_POST['submit']))
{
  $fname = htmlspecialchars($_POST['fname']);
  $lname = htmlspecialchars($_POST['lname']);
  $mname = htmlspecialchars($_POST['mname']);
  $username = htmlspecialchars($_POST['username']);
  $email = 
  $passwd = $_POST['password'];

}

?>
<html>
<head>
<title>Sign up</title>
</head>
<body>
  <div class="container">
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method=POST>
      <div class="w3-row">
        <label class="w3-text-teal"><b>First name</b></label>
        <input type="text" name="fname" class="w3-input w3-border w3-light-grey">
      </div>
      <div class="w3-row">
        <label class="w3-text-teal"><b>First name</b></label>
        <input type="text" name="lname" class="w3-input w3-border w3-light-grey">
      </div>
      <div class="w3-row">
        <label class="w3-text-teal"><b>First name</b></label>
        <input type="text" name="mname" class="w3-input w3-border w3-light-grey">
      </div>
      <div class="w3-row">
        <label class="w3-text-teal"><b>First name</b></label>
        <input type="text" name="username" class="w3-input w3-border w3-light-grey">
      </div>
      <div class="w3-row">
        <label class="w3-text-teal"><b>First name</b></label>
        <input type="text" name="email" class="w3-input w3-border w3-light-grey">
      </div>
      <div class="w3-row">
        <label class="w3-text-teal"><b>First name</b></label>
        <input type="password" name="password" class="w3-input w3-border w3-light-grey">
      </div>
      <div class="container">
        <input type="submit" name="submit" value="submit">
      </div>
    </form>
  </div>
</body>
</html>