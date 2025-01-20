<?php
require_once __DIR__ . '/../includes/_funcs.php';

$id = $_POST['id'];
$tk_flg = ck_token($id);
if ($tk_flg) {
  $token = "?token=" . $_GET['token'];
} else {
  // 有効期限切れならログアウト
  redirect('../auth/logout.php');
}

$name = htmlSpChar($_POST['name']);
$furigana = htmlSpChar($_POST['furigana']);
$email = htmlSpChar($_POST['email']);
$categories_str = isset($_POST['categories']) && is_array($_POST['categories'])
  ? implode(', ', $_POST['categories'])
  : '';
$subscribeMail = $_POST['subscribe_mail'] !== NULL ? 1 : 0;

$categories_str = htmlSpChar($categories_str);

$pdo = connectDb();
$stmt = $pdo->prepare("UPDATE userdata_table SET name=:name, furigana=:furigana, email=:email, music_category=:music_category, subscribe_mail=:subscribe_mail, date=sysdate() WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':furigana', $furigana, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':music_category', $categories_str, PDO::PARAM_STR);
$stmt->bindValue(':subscribe_mail', $subscribeMail, PDO::PARAM_INT);

$status = $stmt->execute();
if ($status === false) {
  $error = $stmt->errorInfo();
  exit('SQLError:' . print_r($error, true));
} else {
  redirect('./index.php' . $token);
}
