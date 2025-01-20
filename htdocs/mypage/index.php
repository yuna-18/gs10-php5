<?php
require_once __DIR__ . '/../includes/_funcs.php';
session_start();
$id = $_SESSION['id'];
$tk_flg = ck_token($id);
if($tk_flg) {
  $token = "?token=" . $_GET['token'];
} else {
  // 有効期限切れならログアウト
  redirect('../auth/logout.php');
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyPage</title>
  <link rel="stylesheet" href="../assets/css/reset.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body id="mypage">
  <main class="mypage__wrapper">
    <div class="mypage__container">
      <div class="menu__content">
        <ul class="menu__list">
          <li class="menu__item">
            <?= '<a href="../home.php' . $token . '" class="">ホーム</a>' ?>
          </li>
          <li class="menu__item">
            <?= '<a href="./userdata.php' . $token . '" class="">登録情報</a>' ?>
          </li>
          <li class="menu__item">
          <a href="../auth/logout.php">ログアウト</a>
        </li>
        </ul>
      </div>
      <div class="mypage__content">
      </div>
    </div>
    </div>
  </main>
</body>

</html>