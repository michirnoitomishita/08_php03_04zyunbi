<?php

// id受け取り

// GETメソッドで送られてきたidを取得
$id = $_GET['id'];

// DB接続　// user_functions.phpを読み込む
include('user_functions.php');

// user_functions.php内の関数を使ってDBに接続
$pdo = connect_to_db();

// SQL実行
$sql = 'SELECT * FROM user_table WHERE id=:id';

// SQL文をプリペアする
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
// 結果を取得し、$resultに代入
$result = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型userリスト（編集画面）</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-200">
  <div class="p-6 max-w-md mx-auto bg-white rounded-xl shadow-md flex items-center space-x-4">
    <div>
      <div class="text-xl font-medium text-black">DB連携型userリスト（編集画面）</div>
      <a href="user_read.php" class="text-blue-500 hover:underline">一覧画面</a>
      <form action="user_update.php" method="POST">
        <div class="mt-4">
          <label class="block">username:</label>
          <input type="text" name="username" value="<?= $result['username'] ?>" class="mt-1 block w-full rounded-md border-gray-600 shadow-sm">
        </div>
        <div class="mt-4">
          <label class="block">password:</label>
          <input type="password" name="password" class="mt-1 block w-full rounded-md border-gray-600 shadow-sm">
        </div>
        <input type="hidden" name="id" value="<?= $result['id'] ?>">
        <div class="mt-4">
          <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            submit
          </button>
        </div>
      </form>
    </div>
  </div>
</body>


</html>