<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型userリスト（入力画面）</title>
    <!-- Tailwind CSSの読み込み -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
</head>


<body class="bg-gray-200 py-20">
  <div class="flex flex-col items-center">
      <!-- formタグ内にaction属性で指定したuser_create.phpがサブミット時に実行 -->
    <form action="user_create.php" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
      <fieldset>
        <legend class="text-xl font-bold mb-2">DB連携型userリスト（入力画面）</legend>
                <!-- "user_read.php"へのリンク。一覧画面へ移動するためのリンク -->
        <a href="user_read.php" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">一覧画面</a>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="username">username:</label>
          <!-- ユーザ名入力欄。ここに入力したデータがPOSTメソッドによりuser_create.phpへ送信 -->
          <input type="text" name="username" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-6">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="password">password:</label>
          <!-- パスワード入力欄。ここに入力したデータがPOSTメソッドによりuser_create.phpへ送信 -->
          <input type="password" name="password" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div>
          <!-- submitボタン。このボタンが押されると、上記のformタグのaction属性で指定したuser_create.phpが実行 -->
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">submit</button>
        </div>
      </fieldset>
    </form>
  </div>
</body>

</html>