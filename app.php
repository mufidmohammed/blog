<?php

function all_post($conn)
{
  	$sql = "SELECT * FROM `posts` WHERE 1";
  	
    $data = $conn -> query($sql);
  	
    $posts = [];

    while ($row = $data -> fetch_assoc())
    {
        $row['date_posted'] = date('M j Y', strtotime($row['date_posted']));
    
        $posts[] = $row;
	}

    return $posts;
}


function popular_posts($conn)
{

    $sql =  "SELECT `id`, `title`, `msg` FROM `posts` ORDER BY `likes` DESC LIMIT 4";

    $data = $conn -> query($sql);

    $posts = [];

    while ($row = $data -> fetch_assoc()) {
        $posts[] = $row;
    }

    return $posts;

}

function get_comments($post_id, $conn)
{
    $sql = "SELECT `msg`, `likes` FROM `comments` WHERE `postid` = '$post_id' ";

    $data  = $conn -> query($sql);

    $comments = [];

    while ($row = $data -> fetch_assoc())
    {
        $comments[] = $row;
    }

    return $comments;
}

function num_comments($postid, $conn)
{
    // $sql = "SELECT COUNT(`id`) FROM `comments` WHERE `postid` = '$postid'"; 
    $sql = "SELECT `id` FROM `comments` WHERE `postid` = '$postid'";

    $data = $conn -> query($sql);
    
    $cnt = 0;
    
    while ($data->fetch_assoc())
        $cnt++;

    return $cnt;
}

function get_user_by_postid($postid, $conn)
{
    $sql = "SELECT `userid` FROM `posts` WHERE `id`='$postid' ";
    
    $query = $conn -> query($sql);

    $user = $query->fetch_assoc();

    if (! $user) {
        die($conn -> error);
    }

    return $user['userid'];
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