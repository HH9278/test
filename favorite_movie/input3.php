<?php
	require_once('dbClass.php');
	session_start();
	
	// トークンを確認する
	if(isset($_POST['token'], $_SESSION['token']) && ($_POST['token'] === $_SESSION['token'])){
		unset($_SESSION['token']);
		
		// データを変数へ展開する
		$day=date("Y-m-d", strtotime($_SESSION['day']));
		$ifm=$_SESSION['ifm'];
		$cmt=$_SESSION['cmt'];
		
		// DBへデータを書き込む
		$dbc = new DbControl();
		$dbc->dbInsertDat($day, $ifm, $cmt);
		
		// セッション情報を破棄する
		$_SESSION = array();
		
		if (ini_get("session.use_cookies")){
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
		}
		
		session_destroy();
		
	} else {
		header('Location:http://localhost/php_form/favorite_movie/input1.php');
		exit();
	}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
	<title>
		完了画面 - 動画登録
	</title>
</head>
<body>
	<p>登録完了しました。</p>
	<p><a href="input1.php?action=edit">入力画面へ戻る</a></p>
</body>
</html>