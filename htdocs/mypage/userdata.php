<?php
require_once __DIR__ . '/../includes/_funcs.php';
session_start();
$id = $_SESSION['id'];
$tk_flg = ck_token($id);
if ($tk_flg) {
  $token = "?token=" . $_GET['token'];
} else {
  // 有効期限切れならログアウト
  redirect('../auth/logout.php');
}
if (isset($_GET['token'])) {
  if ($tk_flg) {
    $pdo = connectDb();
    $stmt = $pdo->prepare("SELECT * FROM userdata_table WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $status = $stmt->execute();
    if ($status === false) {
      $error = $stmt->errorInfo();
      exit('SQLError:' . print_r($error, true));
    } else {
      $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    }
  } else {
    // 有効期限切れならログアウト
    redirect('../auth/logout.php');
  }
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
  <title>MyPage-ユーザー情報-</title>
  <link rel="stylesheet" href="../assets/css/reset.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body id="userdata">
  <main class="mypage__wrapper form__wrapper">
    <div class="mypage__container form__container">
      <div class="menu__content">
        <ul class="menu__list">
          <li class="menu__item">
            <?= '<a href="./index.php' . $token . '" class="">マイページ</a>' ?>
          </li>
          <li class="menu__item">
            <?= '<a href="../home.php' . $token . '" class="">ホーム</a>' ?>
          </li>
        </ul>
      </div>
      <div class="mypage__content form__content">
        <div class="notation">
          <p>登録情報</p>
        </div>
        <div class="form__outer">
          <p class="register__label">氏名</p>
          <p class="register__content"><?= $userData['name']; ?></p>
        </div>
        <div class="form__outer">
          <p class="register__label">フリガナ</p>
          <p class="register__content"><?= $userData['furigana']; ?></p>
        </div>
        <div class="form__outer">
          <p class="register__label">メール</p>
          <p class="register__content"><?= $userData['email']; ?></p>
        </div>
        <div class="form__outer">
          <p class="register__label">パスワード<span style="font-size: 10px;">※セキュリティ保護のため伏字にしています</span></p>
          <p class="register__content">********</p>
        </div>
        <div class="form__outer">
          <p class="register__label">好きな音楽のカテゴリ</p>
          <p class="register__content"><?= $userData['music_category']; ?></p>
        </div>
        <div class="form__outer">
          <p class="register__label">メールで演奏会の通知を受け取る</p>
          <p class="register__content">
            <?php
            if ($subscribeMail === 1) {
              echo "受け取る";
            } else {
              echo "受け取らない";
            }
            ?>
          </p>
        </div>
      </div>
    </div>
    <?= '<a href="./user.php' . $token . '" class="btn">編集する</a>' ?>
  </main>
</body>

</html>