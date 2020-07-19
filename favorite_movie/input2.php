<?php
  session_start();
  
  if(isset($_SESSION['day'])){
    $day = $_SESSION['day'];
    $ifm = $_SESSION['ifm'];
    $cmt = $_SESSION['cmt'];
  }
  
  $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(48));
  $token = htmlspecialchars($_SESSION['token'],ENT_QUOTES);
  
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
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