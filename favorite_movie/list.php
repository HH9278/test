<?php
	require_once('dbClass.php');
	session_start();
	
	$dbc = new DbControl();
	$stmt = $dbc->dbSelectAll();
	
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
