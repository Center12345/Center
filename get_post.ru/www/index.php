
<html>
<head>
</head>

<body>

<H3>����� GET</H3>

<?php

$name = $_GET["name"];
$fam = $_GET["fam"];
$city = $_GET["city"];
echo "������, " . $name;
echo "</br>";
echo "���� �������: " . $fam;
echo "</br>";
echo "�� �� ������: " . $city;

?>

<form action="" method="get">

<p>���:<br><input type="text" name="name" /> </p>
<p>�������:<br><input type="text" name="fam" /> </p>
<p>�����:<br><input type="text" name="city" /> </p>
<input type="submit" name="help" value="���������">

</form>

<a href="post.php">����� POST</a>



</body>
</html>