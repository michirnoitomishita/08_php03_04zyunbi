<?php
// データ受け取り
// var_dump($_GET);
// exit();
$id = $_GET['id'];
// DB接続
include('user_functions.php');

$pdo = connect_to_db();

// SQL実行
$sql = 'DELETE FROM user_table WHERE id=:id';


$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:user_read.php");
exit();