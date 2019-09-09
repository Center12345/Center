<?php

require "db.php";


$data = $_POST;
if( isset($data['do_login']))
{
	$errors = array();
	$user = R::findOne('users', 'login = ?', array($data['login']));
	if($user) // логин существует
	{
		if($user->password)
		{ // логиним пользователя
			$_SESSION['logged_user'] = $user;
				echo '<div style="color: white;">Вы авторизованы!<br/>Можете перейти на <a href="ii.php"> главную</a> страницу!</div><hr>';
			
		
	
			
		}
		else 
		{
			$errors[] = 'Не верно введён пароль!';
		}
	}
	else
	{
		$errors[] = 'Пользователь с таким логином не найден!';
	}
	
	if ( ! empty($errors)) 
	{
		 echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
	}
	
}



?>
<!doctype html>

<html lang="ru">

<head>
<meta name="author" content="Вячеслав Мезенцев">
   <meta http-equiv="content-language" content="ru">
   <meta http-equiv="content-type" content="text/html; charset=utf-8">  
<link rel="stylesheet" href="../css/style.css">
<meta charset="utf-8">
  <title>Вход в систему</title> 
  
  
</head>

<body>



  


  <h1 id="wrapper1">Авторизация</h1>
  
<div id="wrapper">
	<form id="signin" method="POST" action="login.php" autocomplete="off">
	<div id="i">
		<input type="text" id="user" name="login" value="<?php echo @$data['login']; ?>" placeholder="username" />
		</div>
		<div id="i">
		<input type="password" id="pass" name="password" value="<?php echo @$data['password']; ?>" placeholder="password" />
		</div>
		<button type="submit" name="do_login">&#xf0da;</button>
	</form>
</div>
  sgs
  
  
</body>
</html>
