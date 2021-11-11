<?php

function strip_extension($filename)
{
  // get the last occurrence of '.'
  $ext_index = strrpos($filename, '.');
  // get name of string excluding the extension
  $name = substr($filename, 0, $ext_index);

  return $name;
}

function get_image($postid)
{
  if ($handle = opendir(__DIR__ . '/images'))
  {
    while (false !== ($filename = readdir($handle)))
    {
      if ($postid === strip_extension($filename)) {
        closedir($handle);
        return $filename;
      }
    }
  }
}
