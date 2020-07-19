<?php
  session_start();
  
  $dsn = 'mysql:dbname=favorite_movie;host=localhost;charset=utf8';
  $user = 'root';
  $password = '';
  
  $dbh = new PDO($dsn, $user, $password);
  
  $dbh->query('SET NAMES utf8');
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $sql = "SELECT * FROM inquiries";
  
  $stmt = $dbh->query($sql);
  
  $dbh = null;

?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <title>
    動画一覧
  </title>
</head>
<body>
  <table>
    <tr>
      <th>日付</th><th>コメント</th>
    </tr>
    <?php
      foreach($stmt as $value){
    ?>
    <tr>
      <td><?php echo $value['day']; ?></td><td><?php echo $value['cmt']; ?></td>
    </tr>
    <?php
      }
    ?>
  </table>
</body>
</html>
