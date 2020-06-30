<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form name="form1" method="post" action="confirm.php">
    <p>
        <label for="name">タイトル：</label><input type="text" name="title">
    </p>
    <p>
        <label for="name">本文：</label><textarea name="body_text" cols="30" rows="5"></textarea>
    </p>

    <input type="hidden" name="login_id" value="abc123">
    <p>
        <input type="submit" value="確認">
    </p>
</form>

<div>
  <?php
    print "<p>";
    print "タイトル：".$_POST["title"];
    print "</p>";

    print "<p>";
    print "本文：".nl2br($_POST["body_text"]);
    print "</p>";

    print "<p>";
    print "ログインID：".$_POST["login_id"];
    print "</p>";
?></div>

</body>
</html>