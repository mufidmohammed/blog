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

function get_comments($post_id)
{
    $sql = "SELECT * FROM `comments` WHERE `post_id` = '$post_id' ";

    $data  = $conn -> query($sql);

    $posts = [];

    while ($row = $data -> fetch_assoc())
    {
        $posts[] = $row;
    }

    return $posts;
}
