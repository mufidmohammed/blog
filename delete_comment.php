<?php

$sql = "DELETE FROM `comments` WHERE `userid`='$userid'";

if (! $conn -> query($sql))
{
	die('Error accessing database : ' . $conn -> error);
}

$location = 'public/index.php';

header("location: $location");
