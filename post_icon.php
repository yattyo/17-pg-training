<?php
require_once 'functions.php';
// トゥート投稿

session_start();
redirectToLoginPageIfNotLoggedIn();

$image = $_FILES['image'];
$image_hash = hash_file('md5', $image['tmp_name']);
$file_extention = pathinfo($image['name'],PATHINFO_EXTENSION);
$image_file_name = $image_hash . "." . $file_extention;

/*
echo "<pre>";
var_dump($image);
echo "</pre>";
exit;
*/

move_uploaded_file($image['tmp_name'],dirname(__FILE__) . "/uploaded_icon/" . $image_file_name) ;



$database = getDatabase();
$database->query("
    UPDATE `user`
    SET `icon_image` = '{$image_file_name}'
    WHERE `id` = '{$_SESSION['user_id']}'
    ");

$_SESSION['user_icon_image'] = $image_file_name;
header('Location: /');
