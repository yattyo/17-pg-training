<?php
require_once 'functions.php';
// ログインページ

session_start();

$login_name = $_POST['login_name'];

$database = getDatabase();
$user = $database->query("
    SELECT *
    FROM `user`
    WHERE `login_name` = '{$login_name}'
")->fetch(PDO::FETCH_ASSOC);

if ($user === false) {
    // ログイン失敗
    header('Location: /login.php');
} else {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_login_name'] = $user['login_name'];
    $_SESSION['user_display_name'] = $user['display_name'];
    $_SESSION['user_icon_image'] = $user['icon_image'];
    header('Location: /');
}
