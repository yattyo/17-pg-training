<?php
// トップページ
require_once 'functions.php';

session_start();
redirectToLoginPageIfNotLoggedIn();

$user_login_name = $_SESSION['user_login_name'];

$database = getDatabase();

$toots = $database->query("
    SELECT toot.text,login_name,display_name,image_file_name,icon_image
    FROM `toot`
    INNER JOIN `user` ON user.id = toot.user_id
    ORDER BY toot.created_at desc

")->fetchAll(PDO::FETCH_ASSOC);


?>
<html>
    <head>
        <title>Masatodon(マサトドン)</title>
        <link rel="stylesheet" href="/css/style.css">
        <meta charset="utf-8">
    </head>
    <body>
        <div class="wrapper">
            <div class="container myself-container">
                <div class="myself">
                    <img class="user-icon" src= "<?php echo displayIcon($_SESSION['user_icon_image']) ?>" width="30">
                    <div class="user-name"><?php echo $_SESSION['user_display_name']; ?></div>
                    <div class="user_id">@<?php echo $_SESSION['user_login_name']; ?></div>
                </div>
                <form enctype="multipart/form-data" method="post" action="/post_toot.php">
                    <textarea name="text" placeholder="今なにしてる？" required></textarea>
                    <input type="file" name="image">
                    <div class="toot-button-container">
                        <input type="submit" class="toot-button" value="トゥート!">
                        <a href="/change_icon.php">アイコン変えるよ</a>
                    </div>
                </form>
            </div>

            <div class="container toot-container">
                <div class="label icon-home"><img class="label-icon" src="/img/home.png" width="15" alt="Home - ">ホーム</div>
                <ul>

                <?php foreach($toots as $toot){ ?>
                    <li>
                      <img class="user-icon" src= "<?php echo displayIcon($toot['icon_image']) ?>" width="30">
                      <div class="iconyoko">
                        <div class="yasunoyoko">
                          <div><?php echo $toot["display_name"]; ?></div>
                          <div class="user_id">@<?php echo $toot["login_name"]; ?></div>
                        </div>
                          <p><?php echo $toot["text"]; ?></p>
                            <?php if($toot["image_file_name"] != null ) { ?>
                              <img class="toot-image" src= "/uploaded_image/<?php echo $toot['image_file_name'];?>">
                            <?php } ?>
                      </div>
                    </li>
                <?php } ?>


                </ul>
            </div>

            <div class="container about-container">
                <div class="label icon-asterisk"><img class="label-icon" src="/img/asterisk.png" width="15" alt="Start - ">スタート</div>
                <div class="contents">
                    <p>
                        Masatodonとは全世界のmasatoのために作られた教育用ソーシャル・ネットワーキング・サービスです。<br>
                        あなただけの素敵なサービスをここから成長させていってください。
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
