<?php
	require_once('dbClass.php');
	
	$day = $_GET['day'];
	
	if(empty($day)){
		exit('日付が不正です。');
	}
	
	$dbc = new DbControl();
	$stmt = $dbc->dbSelectByDay($day);
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if(!$result){
		exit('データがありません。');
	}
	
	$ifm = $result['ifm'];
	$cmt = $result['cmt'];
	
	$dbh = null;
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
	<title>確認画面 - 詳細画面</title>
</head>
<body>
	<input type="hidden" name="token" value="<?php echo $token ?>">
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
	<p><a href="list.php">一覧画面へ戻る</a></p>
</body>
</html>