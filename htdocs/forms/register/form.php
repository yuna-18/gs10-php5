<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー登録フォーム</title>
  <link rel="stylesheet" href="../../assets/css/reset.css">
  <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body id="form">
  <main class="form__wrapper">
    <h1>ユーザー登録フォーム</h1>
    <form action="./confirm.php" method="post" class="form__container">
      <div class="form__content">
        <div class="form__outer">
          <label for="name">氏名</label>
          <input type="text" name="name" id="name">
        </div>
        <div class="form__outer">
          <label for="furigana">フリガナ</label>
          <input type="text" name="furigana" id="furigana">
        </div>
        <div class="form__outer">
          <label for="email">メール</label>
          <input type="text" name="email" id="email">
        </div>
        <div class="form__outer">
          <label for="pw">パスワード</label>
          <input type="text" name="pw" id="pw">
        </div>
        <div class="form__outer">
          <p class="question">好きな音楽のカテゴリ</p>
          <ul class="input-check__list">
            <li class="input-check__item">
              <label for="orchestra"><input type="checkbox" name="categories[]" id="orchestra" value="オーケストラ">オーケストラ</label>
            </li>
            <li class="input-check__item">
              <label for="wind-orchestra"><input type="checkbox" name="categories[]" id="wind-orchestra" value="吹奏楽">吹奏楽</label>
            </li>
            <li class="input-check__item">
              <label for="chamber-music-ensemble"><input type="checkbox" name="categories[]" id="chamber-music-ensemble" value="室内楽・アンサンブル">室内楽・アンサンブル</label>
            </li>
            <li class="input-check__item">
              <label for="jazz"><input type="checkbox" name="categories[]" id="jazz" value="ジャズ">ジャズ</label>
            </li>
            <li class="input-check__item">
              <label for="solo"><input type="checkbox" name="categories[]" id="solo" value="ソロ">ソロ</label>
            </li>
          </ul>
        </div>
        <div class="form__outer">
          <p class="question">メールで演奏会の通知を受け取れます。</p>
          <div class="input-check__item">
            <label for="subscribe_mail"><input type="checkbox" name="subscribe_mail" id="subscribe_mail" value="1">受け取る</label>
          </div>
        </div>
      </div>
      <div class="btn__container">
        <a href="../../index.php" class="totop-btn btn">TOPへ戻る</a>
        <input type="submit" class="confirm-btn btn" value="確認する">
      </div>
    </form>
  </main>
  <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="../js/index.js"></script> -->
</body>

</html>