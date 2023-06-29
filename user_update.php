<?php
// 入力項目のチェック

if (
  !isset($_POST['username']) || $_POST['username'] === '' ||
  !isset($_POST['password']) || $_POST['password'] === '' ||
  !isset($_POST['id']) || $_POST['id'] === ''
) {
  exit('paramError');
}

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // パスワードをハッシュ化
$id = $_POST['id'];

include('user_functions.php');

// DB接続
// $dbn = 'mysql:dbname=gs_d13_id;charset=utf8mb4;port=3306;host=localhost';
// $user = 'root';
// $pwd = '';

// try {
//   $pdo = new PDO($dbn, $user, $pwd);
// } catch (PDOException $e) {
//   echo json_encode(["db error" => "{$e->getMessage()}"]);
//   exit();
// }
$pdo = connect_to_db();

$sql = 'UPDATE user_table SET username=:username, password=:password WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:user_read.php");
exit();


// DB接続


// SQL実行
