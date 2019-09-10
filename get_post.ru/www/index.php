
<html>
<head>
</head>

<body>

<H3>Метод GET</H3>

<?php

$name = $_GET["name"];
$fam = $_GET["fam"];
$city = $_GET["city"];
echo "Привет, " . $name;
echo "</br>";
echo "Твоя фамилия: " . $fam;
echo "</br>";
echo "Ты из города: " . $city;

?>

<form action="" method="get">

<p>Имя:<br><input type="text" name="name" /> </p>
<p>Фамилия:<br><input type="text" name="fam" /> </p>
<p>Город:<br><input type="text" name="city" /> </p>
<input type="submit" name="help" value="Отправить">

</form>

<a href="post.php">Метод POST</a>



</body>
</html>