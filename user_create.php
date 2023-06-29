<?php
// var_dump($_POST);
// exit();

// POST送信のデータを受け取る。usernameかpasswordが存在しない、もしくは空だった場合はエラーメッセージを返して終了
if (
  !isset($_POST['username']) || $_POST['username'] === '' ||
  !isset($_POST['password']) || $_POST['password'] === ''
) {
  exit('paramError');
}

// $_POSTからusernameとpasswordを取得
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // パスワードをハッシュ化

// user_functions.phpを読み込む
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

// user_functions.php内の関数を使ってDBに接続
$pdo = connect_to_db();

// SQL文を作成。ユーザーデータをINSERTする
$sql = 'INSERT INTO user_table(id, username, password,is_admin, created_at, updated_at,deleted_at) VALUES(NULL, :username, :password,0, now(), now(),NULL)';

// SQL文をプリペアする　// SQL文のパラメータに値をバインドする
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:user_input.php");
exit();
