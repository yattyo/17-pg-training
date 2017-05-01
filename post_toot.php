<?php
require_once 'functions.php';
// トゥート投稿

session_start();
redirectToLoginPageIfNotLoggedIn();

$text = $_POST['text'];
$timestamp = date("Y-m-d H:i:s");

$database = getDatabase();
$database->query("
    INSERT INTO `toot` (
        `user_id`,
        `text`,
        `created_at`
        ) VALUES (
          '{$_SESSION['user_id']}',
          '{$text}',
          '{$timestamp}'
          )
    ");

header('Location: /');
