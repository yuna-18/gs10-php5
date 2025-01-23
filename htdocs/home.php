<?php
require_once __DIR__ . '/includes/_funcs.php';

session_start();
$id = $_SESSION['id'];
$tk_flg = ck_token($id);
if($tk_flg) {
  $token = "?token=" . $_GET['token'];
} else {
  // 有効期限切れならログアウト
  redirect('./auth/logout.php');
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
      $selectedMusicCategories = explode(', ', $userData['music_category']);
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
  <title>ホーム画面</title>
  <link rel="stylesheet" href="./assets/css/reset.css">
  <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
  <header class="menu__content">
  <h1>音報</h1>
    <ul class="menu__list">
      <li class="menu__item">
        <?= "ようこそ " . $userData['name'] . " さん" ;?>
      </li>
      <li class="menu__item">
        <?= '<a href="./mypage/index.php' . $token . '" class="mypage">マイページ</a>' ?>
      </li>
      <li class="menu__item">
        <a href="./auth/logout.php">ログアウト</a>
      </li>
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
  </main>
  <script async src="https://cse.google.com/cse.js?cx=349714df9516f4648"></script>
</body>

</html>