<?php

require_once 'db_connect/connect.php';
require_once 'app.php';
require_once 'uploads.php';


session_start();

if (! isset($_SESSION['userid'])) {
	header('location: login.php');
}

$userid = $_SESSION['userid'];
  
$posts = all_post($conn);
$popular_posts = popular_posts($conn);

$user = get_user_by_id($userid, $conn);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Bloggers Hub</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="static/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
  body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
  </style>
  <script src="js/ajax.js"></script>
</head>
<body class="w3-light-grey">

<div class="w3-content" style="max-width:1400px">

<header class="w3-container w3-center w3-padding-32"> 
  <h1><b>Bloggers hub</b></h1>
  <p >Welcome to your personal blogging space</p>
</header>

<div class="w3-container w3-right">
  <a href="logout.php" class='w3-btn w3-card w3-light-grey'>Logout</a>
</div>

<div class="w3-container">
  <a href="add_post.php" class='w3-btn w3-card w3-light-grey'>Add Post</a>
</div>

<!-- Grid -->
<div class="w3-row">

<!-- Blog entries -->
<div class="w3-col l8 s12">

<?php foreach($posts as $key => $post) : ?>
  <!-- Blog entry -->
  <div class="w3-card-4 w3-margin w3-white">
    <!-- Display blog image (if any) -->
    <?php if (get_image($post['id'])): ?>
      <img src="<?= 'images/' . get_image($post['id']) ?>" style="width:100%" alt="">
    <?php endif ?>
    <div class="w3-container">
      <h3><b><?= $post['title'] ?? "" ?></b></h3>
      <h5><span class="w3-opacity"> <?= $post['date_posted'] ?? "" ?></span></h5>
    </div>

    <div class="w3-container">
      <p>
        <?php
          echo $post['msg'];
        ?>
      </p>
      <div class="w3-row">
        <form>
          <span class="w3-padding w3-left">
            <div class="w3-btn" onclick="changeLikes('like.php?postid=', <?= $post['id'] ?>)">
              <i id="<?= 'likeBtn' . $post['id'] ?>" style="color: <?= like_btn_color($post['id'], $userid, $conn) ?>" class="fa fa-thumbs-o-up" aria-hidden="true"></i>
            </div>
            <span id="<?= $post['id'] ?>"> <?= $post['likes'] ?></span>
          </span>
        </form>
      </div>
      <?php if($post['userid'] === $userid): ?>
        <p><a href="delete_post.php?postid=<?= $post['id'] ?>">delete</a></p>
      <?php endif ?>
      <div class="w3-row">
        <div class="w3-col m8 s12">
          <p><button id="<?= 'all_post' . $key ?>" class="w3-button w3-padding-large w3-white w3-border w3-disabled"><b>READ MORE ??</b></button></p>
        </div>
        <div class="w3-col m4 w3-hide-small">
          <p><span class="w3-padding-large w3-right"><a href="show_comments.php?id=<?= $post['id']; ?>"><b>Comments ??</b></a> <span class="w3-tag"><?= num_comments($post['id'], $conn); ?></span></p>
        </div>
      </div>
    </div>
  </div>
  <hr>
<?php endforeach ?>
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
      <?php foreach($popular_posts as $popular): ?>
        <li class="w3-padding-16">
          <span class="w3-medium"><?= $popular['title'] ?? "Untitled post" ?></span><br>
        </li>
      <?php endforeach ?>
    </ul>
  </div>
  <hr>   
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