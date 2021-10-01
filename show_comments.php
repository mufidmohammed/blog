<?php

$id = $_GET['id'];

$post_query = "SELECT `title`, `msg`, `likes` FROM `posts` WHERE `id` = '$id' ";

$comment_query = "SELECT `msg`, `likes` FROM `comments` WHERE `postid` = '$id' ";

$post_content = $conn -> query($post_query);

if ($post_content) {
    $post = $post_content -> fetch_assoc();
} else {
    echo "An unexpected error occurred : " . $conn->error;
}

$comments_content = $conn -> query($comment_query);

if ($comments_content) {
    $comments = $comments_content -> fetch_assoc();
} else {
    echo "An unexpected error occured : " . $conn->error;
}

?>
<!DOCTYPE html>
<html lang='en'>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="static/w3.css" >
</head>
<body>
  <div class="w3-content" style="max-width:1400px">
    <div class="w3-row">
      <div class="w3-col l8 s12 w3-center">
        <div class="w3-card w3-margin w3-white">
          <!-- image -->
          <div class="w3-container">
            <h3><b><? $post['title']; ?></b></h3>
            <h5><span class="w3-opacity"><? $post['date_posted']; ?></span></h5>
          </div>

          <div class="w3-container">
            <p><? $post['msg']; ?></p>
          </div>

          <div class="w3-container">
            <form method="POST" action="./add_comments.php?id=<? $id; ?>">
              <input type="text" class="w3-input">
              <input type="number" name="userid" value="<? $_GET['userid']; ?>" style="display:none">
              <input type="submit" name="Add" value="add_comment" class="w3-input w3-teal" />
            </form>
            <?php foreach($comments as $comment) : ?>
              <div class="w3-row">
                <div class="w3-card w3-margin w3-white">
                  <div class="w3-container">
                    <p><? $comment['msg']; ?></p>
                    <div class="w3-row">
                      <p><span class="w3-padding">likes: <? $comment['likes']; ?></span> <span class="w3-padding-large w3-right"><? comment['date']; ?></span></p>
                    </div>
                  </div>
                </div>
              </div>
              <hr />
            <?php endforeach ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>