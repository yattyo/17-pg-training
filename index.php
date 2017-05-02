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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/modaal/0.3.1/css/modaal.min.css">
        <script
          src="https://code.jquery.com/jquery-3.2.1.min.js"
          integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
          crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/modaal/0.3.1/js/modaal.min.js"></script>
        <meta charset="utf-8">

    </head>
    <body>
        <div class="wrapper">
            <div class="container myself-container">
                <div class="myself">
                    <a href="/change_profile.php">
                      <img class="user-icon" src= "<?php echo displayIcon($_SESSION['user_icon_image']) ?>" width="30">
                    </a>
                    <div class="user-name"><?php echo $_SESSION['user_display_name']; ?></div>
                    <div class="user_id">@<?php echo $_SESSION['user_login_name']; ?></div>
                </div>
                <form enctype="multipart/form-data" method="post" action="/post_toot.php">
                    <textarea class="textbox" name="text" placeholder="今なにしてる？" required></textarea>
                    <input type="file" name="image">
                    <div class="toot-button-container">
                        <input type="submit" class="toot-button" value="トゥート!">

                    </div>
                </form>
            </div>

            <div class="container toot-container">
                <div class="label icon-home"><img class="label-icon" src="/img/home.png" width="15" alt="Home - ">ホーム</div>
                <ul>

                <?php foreach($toots as $toot){ ?>
                    <li>
                      <img class="user-icon" src= "<?php echo displayIcon($toot['icon_image']) ?>" width="30">
                      <div class="toot-content">
                          <span><?php echo $toot["display_name"]; ?></span>
                          <span class="user_id">@<?php echo $toot["login_name"]; ?></span>
                          <p><?php echo str_replace ( "@" . $_SESSION['user_login_name'] . " " , '<span class="called_name">@' . $_SESSION['user_login_name'] . '</span> '  , $toot["text"] ); ?></p>

                          <?php if($toot["image_file_name"] != null ) { ?>
                            <a href="/uploaded_image/<?php echo $toot['image_file_name'];?>" class="toot-modal">
                              <img class="toot-image" src= "/uploaded_image/<?php echo $toot['image_file_name'];?>">
                            </a>
                          <?php } ?>
                          <div class="buttons">
                            <img class="reply_button" src="/img/reply_button.png">
                            <img class="fav_button" src="/img/fav_button.png">
                            <span class="fav_num">0</span>
                          </div>
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
        <script>
          $(function(){
            $('.toot-modal').modaal({
              type: 'image'
            });

            $('.buttons .reply_button').on(
              'click',
              function(){
                var login_name = $(this).closest('.toot-content').find('.user_id').text();
                $('textarea.textbox').val(login_name + " ");
                $('textarea.textbox').focus();
              }
            )

            $('.buttons .fav_button').on(
              'click',
              function(){
                $(this).attr("src","/img/fav_button_yellow.png");
                var now_fav_num = $(this).next('.fav_num').text();
                $(this).next('.fav_num').text(Number(now_fav_num) + 1);
              })
          })
        </script>

    </body>
</html>
