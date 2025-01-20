<?php
require_once __DIR__ . '/../../includes/_funcs.php';
// 受け取る値が配列以外
$name = htmlSpChar($_POST['name']);
$furigana = htmlSpChar($_POST['furigana']);
$email = htmlSpChar($_POST['email']);
$pw = pw_hash($_POST['pw']);
$subscribeMail = (isset($_POST['subscribe_mail'])) ? 1 : 0;


session_start();
// unset($_SESSION['subscribe_mail']); // 新しい変数名もリセット（念のため）
$_SESSION['name'] = $name;
$_SESSION['furigana'] = $furigana;
$_SESSION['email'] = $email;
$_SESSION['pw'] = $pw;
$_SESSION['subscribe_mail'] = $subscribeMail;

// 複数選択　音楽カテゴリ処理
if (isset($_POST['categories']) && is_array($_POST['categories'])) {
  // 配列内の値の処理
  $categories = array_map('htmlspecialchars', $_POST['categories']);

  // セッションに保存
  $_SESSION['categories'] = $categories;

  // print_r($_SESSION['categories']);
} else {
  // からの配列をセッションに保存
  $_SESSION['categories'] = [];
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>登録内容確認</title>
  <link rel="stylesheet" href="../../assets/css/reset.css">
  <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body id="confirm">
  <main class="form__wrapper">
    <div class="form__container">
      <div class="form__content">
        <div class="notation">
          <p>以下の内容で登録します。</p>
        </div>
        <div class="form__outer">
          <p class="register__label">氏名</p>
          <p class="register__content"><?= $name; ?></p>
        </div>
        <div class="form__outer">
          <p class="register__label">フリガナ</p>
          <p class="register__content"><?= $furigana; ?></p>
        </div>
        <div class="form__outer">
          <p class="register__label">メール</p>
          <p class="register__content"><?= $email; ?></p>
        </div>
        <div class="form__outer">
          <p class="register__label">パスワード<span style="font-size: 10px;">※セキュリティ保護のため伏字にしています</span></p>
          <p class="register__content">********</p>
        </div>
        <div class="form__outer">
          <p class="register__label">好きな音楽のカテゴリ</p>
          <?php
          if (!empty($_SESSION['categories'])) {
            echo '<ul class="register__content--list">';
            foreach ($_SESSION['categories'] as $category) {
              echo '<li class="register__content">' . $category . '</li>';
            }
            echo '</ul>';
          } else {
            echo '<p class="register__content">選択されたカテゴリはありません。</p>';
          }
          ?>
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
    <form action="./complete.php" method="post">
      <?php
      echo '<input type="hidden" name="name" id="name" value="' . $name . '">';
      echo '<input type="hidden" name="furigana" id="furigana" value="' . $furigana . '">';
      echo '<input type="hidden" name="email" id="email" value="' . $email . '">';
      echo '<input type="hidden" name="pw" id="pw" value="' . $pw . '">';
      if (!empty($_SESSION['categories'])) {
        foreach ($_SESSION['categories'] as $category) {
          echo '<input type="hidden" name="categories[]" value="' . $category . '">';
        }
      }
      echo '<input type="hidden" name="subscribe_mail" id="subscribe_mail" value="' . $subscribeMail . '">';
      ?>
      <div class="btn__container">
        <button type="button" onclick="history.back()" class="back-btn btn">戻る</button>
        <input type="submit" class="submit-btn btn" value="送信">
      </div>
    </form>
  </main>
  <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="../js/index.js"></script> -->
</body>

</html>