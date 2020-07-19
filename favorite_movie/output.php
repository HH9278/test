<?php
  session_start();
  
  $day=date("Y-m-d");
  
  $dsn = 'mysql:dbname=favorite_movie;host=localhost;charset=utf8';
  $user = 'root';
  $password = '';
  
  $dbh = new PDO($dsn, $user, $password);
  
  $dbh->query('SET NAMES utf8');
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $sql = "SELECT * FROM inquiries WHERE day= '".$day."'";
  
  $stmt = $dbh->query($sql);
  
  foreach($stmt as $value){
    $ifm = $value['ifm'];
    $cmt = $value['cmt'];
    break;
  }
  
  $dbh = null;
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>
    動画公開
  </title>
</head>
<body>
  <table>
    <tr>
      <th>日付</th><td><?php echo $day; ?></td>
    </tr>
    <tr>
      <th>IFRAME</th><td><?php echo htmlspecialchars_decode($ifm, ENT_QUOTES); ?></td>
    </tr>
    <tr>
      <th>コメント</th><td><?php echo nl2br($cmt); ?></td>
    </tr>
  </table>
</body>
</html>