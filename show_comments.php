<?php

require_once "db_connect/connect.php";
require_once "app.php";

session_start();

if (! isset($_SESSION['userid'])) {
	header('location: login.php');
}

$postid = $_GET['id'];

$userid = $_SESSION['userid'];

$post_query = "SELECT `title`, `msg`, `likes` FROM `posts` WHERE `id` = '$postid' ";

$post_content = $conn -> query($post_query);

if ($post_content) {
    $post = $post_content -> fetch_assoc();
} else {
    echo "An unexpected error occurred : " . $conn->error;
}

$comments = get_comments($postid, $conn);

?>
<!DOCTYPE html>
<html lang='en'>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="static/w3.css" >
</head>
<body>
  <div class="w3-margin"></div>
  <div class="w3-container">
    <a href="blog.php" class='w3-btn w3-card w3-light-grey'>Back</a>
  </div>
  <div class="w3-content" style="max-width:900px">
    <div class="w3-row">
      <div class="w3-col l8 s12 w3-center">
        <div class="w3-card w3-margin w3-white">
          <!-- image -->
          <img src="images/woods.jpg" alt="Nature" style="width:100%">
          <div class="w3-container">
            <h3><b><?= $post['title'] ?? ""; ?></b></h3>
            <h5><span class="w3-opacity"><?= $post['date_posted'] ?? ""; ?></span></h5>
          </div>

          <div class="w3-container">
            <p><?= $post['msg']; ?></p>
          </div>

          <div class="w3-container">
            <form method="POST" action="add_comment.php">
              <input type="text" class="w3-input w3-border" name='comment' placeholder='Comment....' required >
              <input type="number" class="w3-input w3-border" name='postid' value="<?= $postid; ?>" style="display:none">
              <br />
              <input type="submit" name="Add" value="add_comment" class="w3-input w3-teal" />
            </form>
            <?php if ($comments) : ?>
            <?php foreach($comments as $comment) : ?>
              <div class="w3-row">
                <div class="w3-card w3-margin w3-white">
                  <div class="w3-container">
                    <p><?= $comment['msg'] ?? "No comments yet"; ?></p>
                    <div class="w3-row">
                      <p>
                        <span class="w3-padding w3-left">likes: <?= $comment['likes'] ?? ""; ?></span>
                        <span><a href="delete_comment.php?comment_id=<?= $comment['id']; ?>">delete</a></span>
                        <span class="w3-padding-large w3-right"><?= $comment['date_posted'] ?? ""; ?></span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <hr />
            <?php endforeach ?>
            <?php endif ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>