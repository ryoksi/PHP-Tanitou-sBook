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

  $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
  $user='root';
  $password='';
  $dbh=new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  $sql='SELECT name,price,gazou FROM mst_product WHERE code=?';
  $stmt=$dbh->prepare($sql);
  $data[]=$pro_code;
  $stmt->execute($data);

  $rec=$stmt->fetch(PDO::FETCH_ASSOC);
  $pro_name=$rec['name'];
  $pro_price=$rec['price'];
  $pro_gazou_name=$rec['gazou'];

  $dbh=null;

  if ($pro_gazou_name=='') {
    $disp_gazou='';
  }
  else {
    $disp_gazou='<img src="../product/images/'.$pro_gazou_name.'">';
  }

  print '<a href="shop_cartin.php?procode='.$pro_code.'">カートに入れる</a><br>';

} catch (Exception $e) {
  print 'ただいまサーバーエラーのため接続できません。お手数ですが時間をおいてから再度お試しください';
  exit();
}

 ?>

 <p>商品情報参照</p><br>
 <p>商品コード</p>
 <?php print $pro_code; ?>
 <br>
 <p>商品名</p>
 <?php print $pro_name; ?><br>
 <p>価格</p>
 <?php print $pro_price."円"; ?><br>
 <?php print $disp_gazou; ?>
 <form method="post" action="staff_edit_check.php">
 <input type="button" onclick="history.back()" value="戻る">
</form>

</body>
</html>
