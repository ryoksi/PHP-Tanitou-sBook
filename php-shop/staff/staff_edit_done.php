<?php
  session_start();
  session_regenerate_id(true);
  if (isset($_SESSION['login'])==false) {
    print 'ログインされていません';
    print '<br>';
    print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
  }
  else {
    print $_SESSION['staff_name'];
    print 'さんがログイン中';
    print '<br>';
  }
 ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Document</title>
</head>
<body>
  <?php
    require_once('../common/common.php');

  try {
    $post=sanitize($_POST);
    $staff_code=$post['code'];
    $staff_name=$post['name'];
    $staff_pass=$post['pass'];

    $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
    $user='root';
    $password='';
    $dbh=new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql='UPDATE mst_staff SET name=?,password=? WHERE code=?';
    $stmt=$dbh->prepare($sql);
    $data[]=$staff_name;
    $data[]=$staff_pass;
    $data[]=$staff_code;
    $stmt->execute($data);

    $dbh=null;

  }

  catch (Exception $e) {
    print 'ただいまサーバーエラーのため接続できません。お手数ですが時間をおいてから再度お試しください';
    exit();
  }

   ?>
　<p>修正しました。</p>
   <a href="staff_list.php">戻る</a>

</body>
</html>
