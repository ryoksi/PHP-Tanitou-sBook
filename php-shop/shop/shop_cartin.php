<?php
  session_start();
  session_regenerate_id(true);
  if (isset($_SESSION['member_login'])==false) {
    print 'ようこそゲスト様';
    print '<br>';
    print '<a href="member_login.html">会員ログイン</a>';
    print '<br>';
  }
  else {
    print 'ようこそ';
    print $_SESSION['member_name'];
    print '様';
    print '<a href="member_logout.php">ログアウト</a><br>';
    print '<br>';
  }
 ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="css/style.css">
  <title>Document</title>
</head>
<body>
<?php

try {
  $pro_code=$_GET['procode'];

  if (isset($_SESSION['cart'])==true) {
    $cart=$_SESSION['cart'];
    $kazu=$_SESSION['kazu'];
    if (in_array($pro_code,$cart)==true) {
      print 'その商品はすでにカートに入っています';
      print '<br>';
      print '<a href="shop_list.php">商品一覧に戻る</a>';
      exit();
    }
  }

  $cart[]=$pro_code;
  $kazu[]=1;
  $_SESSION['cart']=$cart;
  $_SESSION['kazu']=$kazu;

} catch (Exception $e) {
  print 'ただいまサーバーエラーのため接続できません。お手数ですが時間をおいてから再度お試しください';
  exit();
}

 ?>
 <p>カートに追加しました</p>
 <a href="shop_list.php">商品一覧に戻る</a>
</body>
</html>
