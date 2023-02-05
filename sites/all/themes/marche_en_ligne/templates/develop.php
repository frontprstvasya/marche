<?php
$name = $view->name;

if ($name === 'views_reviews_autgor_user') {
  $view->args[0] ? $arg = $view->args[0] : $arg = FALSE;
  global $user;

  if ($arg === $user->uid) {
    print "true";
  }
}


$path = $_GET['q'];
$explode_url = explode("/", $path);
if(isset($explode_url['1'])) {
  $url_uid = $explode_url['1'];
  global $user;

  if($url_uid  ===  $user->uid){
    return true;
  }
}
