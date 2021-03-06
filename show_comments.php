<?php

require_once "db_connect/connect.php";
require_once "app.php";
require_once "uploads.php";

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="js/ajax.js"></script>
</head>
<body class="w3-light-grey">
  <div class="w3-margin"></div>
  <div class="w3-container">
    <a href="index.php" class='w3-btn w3-card w3-light-grey'>Back</a>
  </div>
  <div class="w3-content" style="max-width:900px">
    <div class="w3-row">
      <div class="w3-col l8 s12 w3-center">
        <div class="w3-card w3-margin w3-white">
          <?php if (get_image($postid)): ?>
            <img src="<?= 'images/' . get_image($postid) ?>" alt="Nature" style="width:100%">
          <?php endif ?>
          <div class="w3-container">
            <h3><b><?= $post['title'] ?? "" ?></b></h3>
            <h5><span class="w3-opacity"><?= $post['date_posted'] ?? "" ?></span></h5>
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
                    <p><?= $comment['msg'] ?></p>
                    <div class="w3-row">
                      <p>
                        <form>
                          <span class="w3-padding w3-left">
                            <div class="w3-btn" onclick="changeLikes('like.php?commentID=', <?= $comment['id'] ?>)">
                              <i id="<?= 'likeBtn' . $comment['id'] ?>"style="color: <?= like_btn_color($comment['id'], $userid, $conn) ?>" class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                            </div>
                            <span id="<?= $comment['id'] ?>"> <?= $comment['likes'] ?></span>
                          </span>
                        </form>
                        <?php if ($userid === $comment['userid']): ?>
                          <span class="w3-btn w3-hover-red">
                            <a class="w3-link" href="delete_comment.php?commentID=<?= $comment['id'] ?>&postid=<?= $postid ?>">delete</a>
                          </span>
                        <?php endif ?>
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