<?php

require_once 'db_connect/connect.php';
require_once 'app.php';

session_start();

if (! isset($_SESSION['userid'])) {
	header('location: login.php');
}

$userid = $_SESSION['userid'];
  
$posts = all_post($conn);
$popular = popular_posts($conn);

if ($userid !== 0)
  $user = get_user_by_id($userid, $conn);
else
  $user = "";

?>

<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="static/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<style>
body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">

<div class="w3-content" style="max-width:1400px">

<header class="w3-container w3-center w3-padding-32"> 
  <h1><b>Bloggers hub</b></h1>
  <p >Welcome to your personal blogging space</p>
</header>

<div class="w3-container">
  <a href="add_post.php" class='w3-btn w3-card w3-light-grey'>Add Post</a>
</div>

<!-- Grid -->
<div class="w3-row">

<!-- Blog entries -->
<div class="w3-col l8 s12">

<!-- Blog entries -->
<?php foreach($posts as $key => $post) : ?>
  <!-- Blog entry -->
  <div class="w3-card-4 w3-margin w3-white">
    <img src="images/woods.jpg" alt="Nature" style="width:100%">
    <div class="w3-container">
      <h3><b><?= $post['title'] ?? ""; ?></b></h3>
      <h5><span class="w3-opacity"> <?= $post['date_posted'] ?? ""; ?></span></h5>
    </div>

    <div class="w3-container">
      <p>
        <?php
          // $content = substr($post['msg'], 255);
          // echo $content;
          echo $post['msg'];
        ?>
      </p>
      <?php if($post['userid'] === $userid): ?>
        <p><a href="delete_post.php?postid=<?= $post['id']; ?>">delete</a></p>
      <?php endif ?>
      <div class="w3-row">
        <div class="w3-col m8 s12">
          <p><button id="<?= 'all_post' . $key; ?>" class="w3-button w3-padding-large w3-white w3-border w3-disabled"><b>READ MORE »</b></button></p>
        </div>
        <div class="w3-col m4 w3-hide-small">
          <p><span class="w3-padding-large w3-right"><a href="show_comments.php?id=<?= $post['id']; ?>"><b>Comments  </b></a> <span class="w3-tag"><?= num_comments($post['id'], $conn); ?></span></p>
        </div>
      </div>
    </div>
  </div>
  <hr>
<?php endforeach ?>

  <!-- Blog entry -->
  <div class="w3-card-4 w3-margin w3-white">
  <img src="images/bridge.jpg" alt="Norway" style="width:100%">
    <div class="w3-container">
      <h3><b>BLOG ENTRY</b></h3>
      <h5>Title description, <span class="w3-opacity">April 2, 2014</span></h5>
    </div>

    <div class="w3-container">
      <p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at. Phasellus sed ultricies mi non congue ullam corper. Praesent tincidunt sed
        tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
      <div class="w3-row">
        <div class="w3-col m8 s12">
          <p><button class="w3-button w3-padding-large w3-white w3-border"><b>READ MORE »</b></button></p>
        </div>
        <div class="w3-col m4 w3-hide-small">
          <p><span class="w3-padding-large w3-right"><b>Comments  </b> <span class="w3-badge">2</span></span></p>
        </div>
      </div>
    </div>
  </div>
<!-- END BLOG ENTRIES -->
</div>

<!-- Introduction menu -->
<div class="w3-col l4">
  <!-- About Card -->
  <div class="w3-card w3-margin w3-margin-top">
  <img src="images/avatar_g.jpg" style="width:100%">
    <?php if ($user) : ?>
    <div class="w3-container w3-white">
      <h4><b><?= $user['username'] ?? ""; ?></b></h4>
      <p><?= $user['about'] ?? 'Just me, myself and I, exploring the universe of uknownment. I have a heart of love and a interest of lorem ipsum and mauris neque quam blog. I want to share my world with you.' ?></p>
    </div>
    <?php endif ?>
  </div><hr>
  
  <!-- Posts -->
  <div class="w3-card w3-margin">
    <div class="w3-container w3-padding">
      <h4>Popular Posts</h4>
    </div>
    <ul class="w3-ul w3-hoverable w3-white">
      <li class="w3-padding-16">
        <img src="images/workshop.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
        <span class="w3-large"><?= $popular['title'] ?? "Lorem"; ?></span><br>
        <span>Sed mattis nunc</span>
      </li>
      <li class="w3-padding-16">
        <img src="images/gondol.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
        <span class="w3-large"><?= $popular['title'] ?? "Ipsum"; ?></span><br>
        <span>Praes tinci sed</span>
      </li> 
      <li class="w3-padding-16">
        <img src="images/skies.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
        <span class="w3-large"><?= $popular['title'] ?? "Dorum"; ?></span><br>
        <span>Ultricies congue</span>
      </li>   
      <li class="w3-padding-16 w3-hide-medium w3-hide-small">
        <img src="images/rock.jpg" alt="Image" class="w3-left w3-margin-right" style="width:50px">
        <span class="w3-large"><?= $popular['title'] ?? "Mingsum"; ?></span><br>
        <span>Lorem ipsum dipsum</span>
      </li>  
    </ul>
  </div>
  <hr> 
 
  <!-- Labels / tags -->
  <div class="w3-card w3-margin">
    <div class="w3-container w3-padding">
      <h4>Tags</h4>
    </div>
    <div class="w3-container w3-white">
    <p><span class="w3-tag w3-black w3-margin-bottom">Travel</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">New York</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">London</span>
      <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">IKEA</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">NORWAY</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">DIY</span>
      <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Ideas</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Baby</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Family</span>
      <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">News</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Clothing</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Shopping</span>
      <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Sports</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Games</span>
    </p>
    </div>
  </div>
  
<!-- END Introduction Menu -->
</div>

<!-- END GRID -->
</div><br>

<!-- END w3-content -->
</div>

<!-- Footer -->
<footer class="w3-container w3-dark-grey w3-padding-32 w3-margin-top">
  <div class="w3-text-muted">Your very own blogging site</div>
</footer>

</body>
</html>

<?php $conn -> close(); ?>