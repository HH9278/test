<?php
	require_once('dbClass.php');
	session_start();
	
	// DBから今日の日付のデータをSELECTする
	$day=date("Y-m-d");
	
	$dbc = new DbControl();
	$stmt = $dbc->dbSelectByDay($day);
	
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
	<link rel="stylesheet" href="style.css">
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
		<tr>
			<td colspan="2" align="right">
				<a href="input1.php">登録画面を開く</a>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="right">
				<a href="list.php">一覧を開く</a>
			</td>
		</tr>
	</table>
</body>
</html>