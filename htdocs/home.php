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
  <main class="top__wrapper">
    <nav class="menu__content">
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
    </nav>
  </main>
</body>

</html>