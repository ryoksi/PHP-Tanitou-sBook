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

  $post=sanitize($_POST);
  $pro_name=$post['name'];
  $pro_price=$post['price'];
  $pro_gazou=$_FILES['image'];

  if ($pro_gazou['size']>0) {
    if ($pro_gazou['size']>1000000) {
      print '画像が大きすぎます';
      print '<br />';
    }
    else {
      move_uploaded_file($pro_gazou['tmp_name'],'./images/'.$pro_gazou['name']);
      print '<img src="./images/'.$pro_gazou['name'].'">';
      print '<br />';
    }
  }

  if ($pro_name == '') {
    print '商品名が入力されていません <br />';
  }
  else {
    print '商品名:';
    print $pro_name;
    print '<br />';
  }

  if (preg_match('/\A[0-9]+\z/',$pro_price)==0||$pro_gazou['size']>1000000) {
    print '<form>';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '</form>';
  }

  else {
    print '上記の商品を追加します<br />';
    print '<form method="post" action="pro_add_done.php">';
    print '<input type="hidden" name="name" value="'.$pro_name.'">';
    print '<input type="hidden" name="price" value="'.$pro_price.'">';
    print '<input type="hidden" name="gazou_name" value="'.$pro_gazou['name'].'">';
    print '<br />';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '<input type="submit" value="OK">';
    print '</form>';
  }

   ?>
</body>
</html>
