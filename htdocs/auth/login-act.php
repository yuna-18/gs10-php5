<?php
require_once __DIR__ . '/../includes/_funcs.php';
session_start();
$email = htmlSpChar($_POST['email']);
$pw = htmlSpChar($_POST['pw']);

$pdo = connectDb();
$stmt = $pdo->prepare("SELECT * FROM userdata_table WHERE email=:email");
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$status=$stmt->execute();

if($status === false){
  sql_error($stmt);
}
$val = $stmt->fetch();
$token = gen_token($val['id']);
$_SESSION['id'] = $val['id'];

if( $val['id'] != '' && password_verify($pw, $val['pw'])){
  //Login成功時 該当レコードがあればSESSIONに値を代入
  $_SESSION['chk_ssid'] = session_id();
  redirect('../home.php?token='. $token);
}else{
  //Login失敗時(Logout経由)
  redirect('login.php');
}
exit();
?>