<!doctype html>
<?php
	require_once('dbClass.php');
	session_start();
	
	$errors = array();
	
	// 確認画面へボタンを押下したときの処理
	if(isset($_POST['submit'])){
		$day = $_POST['day'];
		$ifm = $_POST['ifm'];
		$cmt = $_POST['cmt'];

		$day = htmlspecialchars($day, ENT_QUOTES);
		$ifm = htmlspecialchars($ifm, ENT_QUOTES);
		$cmt = htmlspecialchars($cmt, ENT_QUOTES);

		if($day === ""){
			$errors['day'] = "日付が入力されていません。";
		}

		if($ifm === ""){
			$errors['ifm'] = "IFRAMEが入力されていません。";
		}

		if($cmt === ""){
			$errors['cmt'] = "コメントが入力されていません。";
		}

		if(count($errors) === 0){
			$_SESSION['day'] = $day;
			$_SESSION['ifm'] = $ifm;
			$_SESSION['cmt'] = $cmt;
			
			header('Location:http://localhost/php_form/favorite_movie/input2.php');
			exit();
		}
	}
	
	// 確認画面から戻った時の処理
	if(isset($_GET['action']) && $_GET['action'] === 'edit'){
		if(isset($_SESSION['day'])){
			$day = $_SESSION['day'];
			$ifm = $_SESSION['ifm'];
			$cmt = $_SESSION['cmt'];
		}
	}
	
	// 直近の空いている日付をデフォルト入力
	if(isset($day) && empty($day) || !isset($day)){
		$dbc = new DbControl();
		$stmt = $dbc->dbSelectAll();
		if($stmt === false){
			$day = date("Y-m-d");
		} else {
			$diff = new DateTime(date("Y-m-d"));
			foreach($stmt as $value){
				$dval = new DateTime($value['day']);
				if($diff == $dval){
					$diff->modify('+1 days');
				}elseif($diff < $dval){
					break;
				}
			}
			$day = $diff->format('Y-m-d');
		}
	}
?>

<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
	<title>動画登録</title>
</head>
<body>
<?php
	// エラー一覧を表示
	echo "<ul>";
	foreach($errors as $value){
		echo "<li>";
		echo $value;
		echo "</li>";
	}
	echo "</ul>";
?>

<form action="input1.php" method="post">
	<table>
		<tr>
			<th>日付</th><td><input type="text" name="day" value="<?php if(isset($day)){ echo $day; } ?>"></td>
		</tr>
		<tr>
			<th>IFRAME</th><td><input type="text" name="ifm" value="<?php if(isset($ifm)){ echo $ifm; } ?>"></td>
		</tr>
		<tr>
			<th>コメント</th>
			<td>
				<textarea name="cmt" cols="40" rows="10"><?php if(isset($cmt)){ echo $cmt; } ?></textarea>
			</td>
		<tr>
			<td colspan="2">
				<input type="submit" name="submit" value="確認画面へ">
			</td>
		</tr>
		<tr>
			<td colspan="2" align="right">
				<a href="https://www.youtube.com/?gl=JP&hl=ja" target="_blank">Youtubeを開く</a>
			</td>
		</tr>
	</table>
</form>
</body>
</html>