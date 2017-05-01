<?php


/**
 * データベースへ接続するためのオブジェクトを取得する
 *
 * @return PDO
 */
function getDatabase() {
    return new PDO('mysql:host=localhost;port=8889;dbname=database', 'root', 'root', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
}

/**
 * ログインしていなかったらログインページで移動する
 */
function redirectToLoginPageIfNotLoggedIn() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /login.php');
        exit;
    }
}

function displayIcon($icon_image) {
  if($icon_image != null ) {
    return "/uploaded_icon/" . $icon_image;
  }else{
    return "/img/masatodon.jpg";
  }
}
