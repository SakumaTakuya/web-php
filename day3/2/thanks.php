<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Title</title>
</head>
<body>

<?php

try{
  $dsn = "mysql:dbname=KCS;host=localhost";
  $user = "root";
  $pass = "";
  $dbh = new PDO($dsn, $user, $pass);
  $dbh->query("SET NAMES utf8");

  $nickname = htmlspecialchars($_POST["nickname"]);
  $email = htmlspecialchars($_POST["email"]);
  $goiken = htmlspecialchars($_POST["goiken"]);

  print $nickname;
  print "様<br />";
  print "ご意見ありがとうございました";
  print "頂いたご意見";
  print $goiken;
  print "<br />";
  print $email;
  print "にメールを送りましたのでご確認ください。";

  $title = "アンケート受け付けました";
  $body = $nickname . "様へ\nアンケート協力ありがとうございました";
  $body = html_entity_decode($body, ENT_QUOTES, "UTF-8");
  $head = "From: xxx@xxx.co.jp";
  mb_language("Japanese");
  mb_internal_encoding("UTF-8");
  mb_send_mail($email, $body, $head);

  $sql = 'INSERT INTO anketo (nickname, email, goiken) VALUES ("'.$nickname .'","'. $email .'","' . $goiken .'")';

  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  $dbh = null;
}catch (Exception $e){
  print "ごめん、いま障害起きてる";
}


?>

</body>
</html>