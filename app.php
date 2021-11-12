<?php

declare(strict_types=1);

require_once "db_connect/connect.php";

function all_post($conn): array
{
  	$sql = "SELECT * FROM `posts` ORDER BY `id` DESC";
  	
    $data = $conn -> query($sql);
  	
    $posts = $data->fetch_all(MYSQLI_ASSOC);

    return $posts;
}


function popular_posts($conn): array
{

    $sql =  "SELECT `id`, `title`, `msg` FROM `posts` ORDER BY `likes` DESC LIMIT 4";

    $data = $conn -> query($sql);

    $posts = $data -> fetch_all(MYSQLI_ASSOC);

    return $posts;
}

function get_comments($post_id, $conn): array
{
    $sql = "SELECT `id`, `msg`, `likes`, `userid` FROM `comments` WHERE `postid` = '$post_id'";

    $data  = $conn -> query($sql);

    $comments = $data -> fetch_all(MYSQLI_ASSOC);

    return $comments;
}

function num_comments($postid, $conn)
{
    $sql = "SELECT COUNT(`id`) FROM `comments` WHERE `postid` = '$postid'";

    $data = $conn -> query($sql);
    
    $result = $data -> fetch_array(MYSQLI_NUM);

    return $result[0];
}

function get_user_by_id($id, $conn)
{
    $sql = "SELECT * FROM `users` WHERE `id` = '$id'";
    $query = $conn->query($sql);
    if ($query)
        $user = $query->fetch_assoc();
    else
        die($conn -> error);
    
    return $user;
}
