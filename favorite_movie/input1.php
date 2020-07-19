<!doctype html>
<?php
  session_start();
  
  $errors = array();
  
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
  if(isset($_GET['action']) && $_GET['action'] === 'edit'){
    if(isset($_SESSION['day'])){
      $day = $_SESSION['day'];
      $ifm = $_SESSION['ifm'];
      $cmt = $_SESSION['cmt'];
    }
  }
?>

<html>
<head>
<meta charset="utf-8">
<title>動画登録</title>
</head>
<body>
<?php
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
  <td olspan="2">
    <input type="submit" name="submit" value="確認画面へ">
  </td>
</tr>
</table>
</form>
</body>
</html>