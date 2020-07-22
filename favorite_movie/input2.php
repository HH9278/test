<?php
	require_once('dbClass.php');
	
	session_start();
	
	// セッション情報から日付、IFRAME、コメントを取得
	if(isset($_SESSION['day'])){
		$day = $_SESSION['day'];
		$ifm = $_SESSION['ifm'];
		$cmt = $_SESSION['cmt'];
		
		// DBから日付指定でSELECTする
		$dbc = new DbControl();
		$stmt = $dbc->dbSelectByDay($day);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		// DBの接続を削除
		$dbh = null;
		
		// データがある場合、登録画面に戻る
		if(!empty($result['ifm'])){
			header('Location:http://localhost/php_form/favorite_movie/input1.php');
		}
	} else {
		exit('データがありません。');
	}
	
	// セキュリティ用トークンを発行する
	$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(48));
	$token = htmlspecialchars($_SESSION['token'],ENT_QUOTES);
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
	<title>確認画面 - 動画登録</title>
</head>
<body>
	<form action="input3.php" method="post">
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
		<tr>
			<td colspan="2"><input type="submit" name="submit" value="送信する"></td>
		</tr>
	</table>
	</form>
	<p><a href="input1.php?action=edit">入力画面へ戻る</a></p>
</body>
</html>