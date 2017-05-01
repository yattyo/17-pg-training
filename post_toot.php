<?php
require_once 'functions.php';
// トゥート投稿

session_start();
redirectToLoginPageIfNotLoggedIn();

$text = $_POST['text'];
$timestamp = date("Y-m-d H:i:s");
$image = $_FILES['image'];

  if($_FILES['image']['name'] === ''){
    $image_file_name = '';
  }else{
$image_hash = hash_file('md5', $image['tmp_name']);
$file_extention = pathinfo($image['name'],PATHINFO_EXTENSION);
$image_file_name = $image_hash . "." . $file_extention;
}

/*
echo "<pre>";
var_dump($image);
echo "</pre>";
exit;
*/

move_uploaded_file($image['tmp_name'],dirname(__FILE__) . "/uploaded_image/" . $image_file_name) ;

$database = getDatabase();
$database->query("
    INSERT INTO `toot` (
        `user_id`,
        `text`,
        `created_at`,
        `image_file_name`
        ) VALUES (
          '{$_SESSION['user_id']}',
          '{$text}',
          '{$timestamp}',
          '{$image_file_name}'
          )
    ");

header('Location: /');
