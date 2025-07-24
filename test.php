<!DOCTYPE html>
<html>
<body>
 
<h2>請輸入你的名字：</h2>

<form method="post" action="">
  名字：<input type="text" name="name">
  <input type="submit" value="送出">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];

    if ($name == "Alice") {
        echo "<h3>Welcome, Alice!</h3>";
    } else {
        echo "<h3>Who are you, $name?</h3>";
    }
}
echo "<h2>PHP is Fun!</h2>";
echo "Hello world!<br>";
echo "I'm about to learn PHP!<br>";
echo "This ", "string ", "was ", "made ", "with multiple parameters.";
?>

</body>
</html>