<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン</title>
</head>
<body>
  <form action="./login-act.php" method="post">
    <div class="contents__wrapper">
      <label for="email">メールアドレス: <input type="text" name="email" id="email"></label>
      <label for="pw">パスワード: <input type="text" name="pw" id="pw"></label>
      <input type="submit" value="ログイン" />
    </div>
  </form>
</body>
</html>