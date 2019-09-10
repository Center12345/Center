

<?php

if(isset($_POST["help"])){
	
	// print_r($_POST);
	
$name = $_POST["name"];
$fam = $_POST["fam"];
$city = $_POST["city"];
echo "Привет, " . $name;
echo "</br>";
echo "Твоя фамилия: " . $fam;
echo "</br>";
echo "Ты из города: " . $city;


}

