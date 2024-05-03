<?php
function h($value){
  return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$dsn = 'mysql:host=localhost;dbname=contact_customer;charset=utf8;';
    $user = 'root';
    $password = '';
try {
  $pdo  =new PDO($dsn, $user, $password);
} catch (PDOException $e){
  echo '接続エラー'. $e->getMessage();
  exit();
}

?>