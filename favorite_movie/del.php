<?php
	require_once('dbClass.php');
	
	$day = $_GET['day'];
	
	if(empty($day)){
		exit('日付が不正です。');
	}
	
	$dbc = new DbControl();
	$stmt = $dbc->dbDeleteByDay($day);
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
	<title>確認画面 - 削除</title>
</head>
<body>
	<input type="hidden" name="token" value="<?php echo $token ?>">
	<p><?php echo $day ?>のデータが削除されました。</p>
	<p><a href="list.php">一覧画面へ戻る</a></p>
</body>
</html>