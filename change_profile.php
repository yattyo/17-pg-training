<?php
// ログインページ
session_start();
?>

<link rel="stylesheet" href="/css/style.css">


<form enctype="multipart/form-data" method="post" action="/post_profile.php">
    <input type="text" name="display_name" value="<?php echo $_SESSION['user_display_name']; ?>" required>
    <input type="file" name="image">
        <input type="submit" class="change-profile-button" value="保存">

</form>
