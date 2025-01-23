<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>サイトトップ</title>
  <link rel="stylesheet" href="./assets/css/reset.css">
  <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body id="top">
  <header class="menu__content">
    <h1>音報</h1>
    <ul class="menu__list">
      <li class="menu__item"><a href="./forms/register/form.php">ユーザー登録</a></li>
      <li class="menu__item"><a href="./auth/login.php">ログイン</a></li>
    </ul>
  </header>
  <main class="top__wrapper">
    <div class="main__content">
      <div class="text__outer">
        <p class="large">音楽カテゴリ・楽器を入力して、<br class="sp">イベントや演奏会情報を検索しよう!</p>
        <p>タブ毎に絞り込んだ検索結果を見ることができます。</p>
      </div>
      <?php
      require_once('./includes/main_content.php');
      ?>

    </div>
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="./js/index.js"></script> -->
  </main>
  <script async src="https://cse.google.com/cse.js?cx=349714df9516f4648"></script>
</body>

</html>