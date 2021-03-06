<?php
	require_once('dbClass.php');
	session_start();
	
	// DBを全データSELECTする
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
			<th>日付</th><th>コメント</th><th>詳細</th><th>削除</th>
		</tr>
		<?php
			// 1行ずつデータを出力する
			foreach($stmt as $value){
		?>
		<tr>
			<td><?php echo $value['day']; ?></td>
			<td><?php echo $value['cmt']; ?></td>
			<td><a href="detail.php?day=<?php echo $value['day']; ?>">詳細</a></td>
			<td><a href="del.php?day=<?php echo $value['day']; ?>">削除</a></td>
		</tr>
		<?php
			}
		?>
		
		</tr>
		<tr>
			<td colspan="4" align="right">
				<a href="output.php">今日の動画</a>
			</td>
		</tr>
		<tr>
			<td colspan="4" align="right">
				<a href="input1.php">登録画面を開く</a>
			</td>
		</tr>
	</table>
</body>
</html>
