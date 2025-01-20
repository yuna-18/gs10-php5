<?php
require_once __DIR__ . '/../config/config.prod.php';
require_once __DIR__ . '/../config/db.php';
//共通に使う関数を記述
//XSS対応（ echoする場所で使用！それ以外はNG ）
function htmlSpChar($stg)
{
  return htmlspecialchars($stg, ENT_QUOTES);
}

//DB接続
function connectDb()
{
  $host = DB_HOST;
  $dbname = DB_NAME;
  $user = DB_USER;
  $password = DB_PASS;
  $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";

  try {
    $pdo = new PDO($dsn, $user, $password);
    return $pdo;
  } catch (PDOException $e) {
    echo '<pre>';
    print_r($e->getMessage()); // デバッグ用に出力
    echo '</pre>';
    exit('DBConnectError' . $e->getMessage());
  }
}

//SQLエラー
function sql_error($stmt)
{
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit('SQLError:' . $error[2]);
}

// ハッシュ化
function pw_hash($pw)
{
  return password_hash($pw, PASSWORD_DEFAULT);
}

// トークン生成
function gen_token($id)
{
  $timestamp = time(); // 現在のタイムスタンプを取得
  $data = $id . "|" . $timestamp; // ユーザーIDとタイムスタンプを結合
  $hash = hash_hmac('sha256', $data, 'LOGIN_SEC_KEY'); // HMACを生成
  // トークンはハッシュとタイムスタンプを結合してエンコード
  $token = base64_encode($hash . "|" . $timestamp);
  return $token;
}

function ck_token($id)
{
  if (!isset($_GET['token'])) {
    return false;
  }
  $received_token = base64_decode($_GET['token']);
  list($old_token, $timestamp) = explode("|", $received_token);

  // タイムスタンプが有効期限内か確認
  if (time() - $timestamp > 3600) { // 1時間を超えている場合
    return false; // トークン無効
  }
  $data = $id . "|" . $timestamp; // ユーザーIDとタイムスタンプを結合
  $new_token = hash_hmac('sha256', $data, 'LOGIN_SEC_KEY'); // 同じロジックでハッシュを生成
  
  // ハッシュが一致するか確認
  return hash_equals($old_token, $new_token); // 安全な比較関数を使用
}

//リダイレクト
function redirect($file_name)
{
  header('Location: ' . $file_name);
  exit();
}

// ログインチェック処理
function loginCheck()
{
  if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id()) {
    exit('LOGIN ERROR');
  }

  session_regenerate_id(true);
  $_SESSION['chk_ssid'] = session_id();
}
