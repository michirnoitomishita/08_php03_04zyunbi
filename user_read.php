<?php
// user_functions.phpを読み込む
include('user_functions.php');

// user_functions.php内の関数を使ってDBに接続
$pdo = connect_to_db();

// $dbn = 'mysql:dbname=YOUR_DB_NAME;charset=utf8mb4;port=3306;host=localhost';
// $user = 'root';
// $pwd = '';

// try {
//   $pdo = new PDO($dbn, $user, $pwd);
// } catch (PDOException $e) {
//   echo json_encode(["db error" => "{$e->getMessage()}"]);
//   exit();
// }
// SQL文を作成。全てのユーザーデータを作成日時の昇順で取得する
$sql = 'SELECT * FROM user_table ORDER BY created_at ASC';

$stmt = $pdo->prepare($sql);

// SQL文を実行し、結果を$statusに代入。エラーがあった場合はエラーメッセージを出力して終了
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
// 結果を取得し、$resultに代入
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 結果を元にHTML文字列を作成し、$outputに代入
$output = "";
foreach ($result as $record) {
  $output .= "
    <tr>
      <td>{$record["username"]}</td>
      <td>{$record["created_at"]}</td>
     <td> 
        <a href='user_edit.php?id={$record["id"]}' class='inline-flex items-center px-2 py-1 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500'>edit</a>
      </td>
      <td> 
        <a href='user_delete.php?id={$record["id"]}' class='inline-flex items-center px-2 py-1 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500'>delete</a>
      </td>
    </tr>
  ";
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型userリスト（一覧画面）</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-200">
  <div class="p-6 max-w-md mx-auto bg-white rounded-xl shadow-md flex items-center space-x-4">
    <div>
      <div class="text-xl font-medium text-black">DB連携型userリスト（一覧画面）</div>
      <a href="user_input.php" class="text-blue-500 hover:underline">入力画面</a>
      <table class="table-auto">
        <thead>
          <tr>
            <th class="px-4 py-2">username</th>
            <th class="px-4 py-2">created_at</th>
            <th class="px-4 py-2"></th>
            <th class="px-4 py-2"></th>
          </tr>
        </thead>
        <tbody>
          <?= $output ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>