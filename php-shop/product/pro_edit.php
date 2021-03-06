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

  $sql='SELECT name,price,gazou FROM mst_product wHERE code=?';
  $stmt=$dbh->prepare($sql);
  $data[]=$pro_code;
  $stmt->execute($data);

  $rec=$stmt->fetch(PDO::FETCH_ASSOC);
  $pro_name=$rec['name'];
  $pro_price=$rec['price'];
  $pro_gazou_name_old=$rec['gazou'];

  $dbh=null;

  if ($pro_gazou_name_old=='') {
    $disp_gazou='';
  }
  else {
    $disp_gazou='<img src="./images/'.$pro_gazou_name_old.'">';
  }

} catch (Exception $e) {
  print 'ただいまサーバーエラーのため接続できません。お手数ですが時間をおいてから再度お試しください';
  exit();
}

 ?>

 <p>商品修正</p><br>
 <p>商品コード</p>
 <?php print $pro_code; ?>
 <br>
 <form method="post" action="pro_edit_check.php" enctype="multipart/form-data">
 <input type="hidden" name="code" value="<?php print $pro_code; ?>">
 <input type="hidden" name="$pro_gazou_name_old" value="<?php print $pro_gazou_name_old; ?>">
 <p>商品名</p>
 <input type="text" name="name" value="<?php print $pro_name; ?>"><br>
 <p>価格</p>
 <input type="text" name="price" value="<?php print $pro_price; ?>">円<br>
 <?php print $disp_gazou; ?><br>
 <p>画像を選んでください</p>
 <input type="file" name="gazou"><br>
 <input type="button" onclick="history.back()" value="戻る">
 <input type="submit" value="OK">
</form>

</body>
</html>
