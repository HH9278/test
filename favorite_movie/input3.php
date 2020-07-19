<?php
  session_start();
  
  if(isset($_POST['token'], $_SESSION['token']) && ($_POST['token'] === $_SESSION['token'])){
    unset($_SESSION['token']);
    
    $day=date("Y-m-d", strtotime($_SESSION['day']));
    $ifm=$_SESSION['ifm'];
    $cmt=$_SESSION['cmt'];
    
    $dsn = 'mysql:dbname=favorite_movie;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    
    $dbh = new PDO($dsn, $user, $password);
    
    $dbh->query('SET NAMES utf8');
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $sql = 'INSERT INTO inquiries (day, ifm, cmt) VALUES (?, ?, ?)';
    
    $stmt = $dbh->prepare($sql);
    
    $stmt->bindValue(1, $day, PDO::PARAM_STR);
    $stmt->bindValue(2, $ifm, PDO::PARAM_STR);
    $stmt->bindValue(3, $cmt, PDO::PARAM_STR);
    
    $stmt->execute();
    
    $dbh = null;
    
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
  <title>
    完了画面 - 動画登録
  </title>
</head>
<body>
  <p>登録完了しました。</p>
  <p><a href="input1.php?action=edit">入力画面へ戻る</a></p>
</body>
</html>