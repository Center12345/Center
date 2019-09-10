
<!doctype html>

<html lang="ru">

<head>
<meta name="author" content="Вячеслав Мезенцев">
   <meta http-equiv="content-language" content="ru">
   <meta http-equiv="content-type" content="text/html; charset=utf-8">  
<link rel="stylesheet" href="/css/styleee.css">
<link rel="stylesheet" href="/css/styl.css">
<meta charset="utf-8">
<script type="text/javascript" src="/js/jquery-1.11.3.js"></script>
  <title>Бронирование</title> 
  
  
</head>

<body>



<div id="top-line"> </div>
 
  <div id="header">
   
  <div id="top-menu">
<a href="ii.php">Главная</a>
<div class="top-menu-line"></div>
</div>

<div id="top-menu">
<a href="spisok1.php">Новости</a>
<div class="top-menu-line"></div>
<a href="rezerr.php">Бронирование</a>
<div class="top-menu-line"></div>
<a href="spisok.php">Курсы</a>
<div class="top-menu-line"></div>
<a href="index1.php">Информация о центре</a>
<a href="index1.php">Выход</a>
</div>
 
  </div>

  



  
<div class="center">

<div >
<br>
Введите название оборудование
<input type="text" id="nвап" name="claпвп" />
<button type="submit" name="doпв">Найти</button><br><br>
</DIV>




	<?

	include_once './class_bron/db.php';

	
	
$data = $_POST;
if( isset($data['do_sig']))
{
	// регистрация
	$errors = array();
	if(trim($data['login']) == '')
	{
		$errors[] = 'Введите логин!';
	}
	
	if(trim($data['phone']) == '')
	{
		$errors[] = 'Введите телефон!';
	}
	
	if (empty($errors)) // успешная регистрация
	{
		
		$user = R::dispense('lesson');
		$user->datetime = $data['datetime'];
		$user->classroom = $data['classroom'];
		$user->login = $data['login'];
		$user->phone = $data['phone'];
		R::store($user);
		
	} else
	{
		echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
	}
	
}

$db= new SafeMySQL();
if(isset($_POST['date_room'])){
	$mesto=$db->getRow("SELECT * FROM bron_time WHERE date=?s AND id_room=?i",$_POST['date_room'],$_POST['id_room']);
	if($mesto[$_POST['seans']]==1){echo 2;}
else{
	if(date("d.m.Y")==$_POST['date_room']){
		$yy=time()+1800;
		$rooms=$db->getRow("SELECT * FROM bron WHERE id=?i",$_POST['id_room']);
			if($rooms[$_POST['seans']]<=date("H:i",$yy)){echo 3;exit;}
	}
	if($_POST['name']=='' or $_POST['phone']==''){echo 1;exit;}	
	if($_POST['id_room']==2 or $_POST['id_room']==1){
	$db->query("UPDATE bron_time SET ".$_POST['seans']."='1' WHERE (id_room=?i or id_room=?i) AND date=?s",'1','2',$_POST['date_room']);
	}else{
	$db->query("UPDATE bron_time SET ".$_POST['seans']."='1' WHERE id_room=?i AND date=?s",$_POST['id_room'],$_POST['date_room']);
	}
	$vrem=$db->getRow("SELECT * FROM bron WHERE id=?i",$_POST['id_room']);
	echo getRooms($_POST['date_room'],$db);
}
	exit;
}

if(isset($_POST['refrash'])){
	echo getRooms(date("d.m.Y"),$db);
	exit;
}

if(isset($_POST['days_re'])){
	echo getRooms($_POST['days_re'],$db);
	exit;
}




$login = $_GET['login'];
$num = $_GET['num'];
$target = $_GET['target'];
$datee = $_GET['datee'];
$timee = $_GET['timee'];
$extra = $_GET['extra'];
$extra1 = $_GET['extra1'];



$db_host = "localhost"; 
$db_user = "root"; // Логин БД
$db_password = ""; // Пароль БД
$db_base = 'user'; // Имя БД
$db_table = "mytable"; // Имя Таблицы БД

$mysqli = new mysqli($db_host,$db_user,$db_password,$db_base);

if ($mysqli->connect_error) {
	    die('Ошибка : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}
    
	$err=''; 
  if (!$login) $err.="Вы забыли написать свое имя<br>"; 
  if (!$num) $err.="Вы забыли написать сам отзыв!<br>"; 
  if (!$target) $err.="Вы забыли написать сам отзыв!<br>";
  if (!$datee) $err.="Вы забыли написать сам отзыв!<br>";
  if (!$timee) $err.="Вы забыли написать сам отзыв!<br>";
  if (!$extra) $err.="Вы забыли написать сам отзыв!<br>";
  if (!$extra1) $err.="Вы забыли написать сам отзыв!<br>";
	if (!$err) { 
    $result = $mysqli->query("INSERT INTO ".$db_table." (login,num,target,datee,timee,extra,extra1) VALUES ('$login','$num','$target','$datee','$timee','$extra','$extra1')");
	}
	 
	
    if ($result == true){
    	echo "Информация занесена в базу данных";
	
    }else{
    	echo "Информация не занесена в базу данных";
    }


	
	
	


?>
<script>
function bron(a,b,c){
	name=$('#name').val();
	phone=$('#phone').val();
	$.post('/bron.php','date_room='+a+'&seans='+b+'&id_room='+c+'&phone='+phone+'&name='+name,function(data){
		switch(data){
			case'1':alert('Ошибка введите имя или телефон!');break;
			case'2':alert('Время уже занто!');break;
			case'3':alert('Вы выбрали уже закрытое время!');break;
			default:$('#rooms_table').html(data);hide_z();
		}
	});
}

function refrash(){
	$.post('/bron.php','refrash=1',function(data){
		switch(data){
			case'1':alert('Ошибка!');break;
			default:$('#rooms_table').html(data);
		}
	});
}

setTimeout('refrash();',200);

function days(a){
	$.post('/bron.php','days_re='+a,function(data){
		switch(data){
			case'1':alert('Ошибка!');break;
			default:$('#rooms_table').html(data);
		}
	});
}

function bron_okno(a,b,c,d,e,f){
	$('#okno_br').show(500);
	$('#date_z').val(a);
	$('#date_z1').val(e);
	$('#name_room').val(d);
	$('#name').val(f);
	$('#but_z').attr('onclick','bron(\''+a+'\',\''+b+'\',\''+c+'\')');
	
}

function hide_z(){
	$('#okno_br').hide(500);
	
}
</script>

<form method="GET" action="index.php">
<div class="okno_all" style="display:none;" id="okno_br">

<div class="okno_one">

<div class="krest" onClick="hide_z();">X</div>

<div class="polay">
<div>
Новое событие
</div>
<input type="text" id="date_z" name="datee"  />

<input type="text" id="date_z1" name="timee"  />

<input type="text" id="name" name="classroom" disabled="disabled" />
<div>
<input type="text" id="name_room" name="classroom" disabled="disabled" />
</div>

<div>
<input type="text" name="login" placeholder="Ваше имя" />
</div>
	<div>	
<input type="text"  name="num" placeholder="Количество человек" />
</div>
<div> &nbsp </div>
Группа
<select id="okno_br" name="extra" >
<option  value="345б" >346б</option>
<option value="891г">891г</option>
<option value="597м">597м</option>
</select>
Факультет
<select id="okno_br" name="extra1" >
<option  value="Лечебный факультет" >Лечебный факультет</option>
<option value="Педиатрический факультет">Педиатрический факультет</option>
<option value="Фармацевтический факультет">Фармацевтический факультет</option>
</select>

<div>	
<input type="text"  name="target"  placeholder="Цель бронирования" />
</div>
<div>	

</div>

<div>
<input type="submit" id="but_z"  value="ЗАБРОНИРОВАТЬ"/>
</div>
 
 

</div>

</div>

</div>
</form>

<?

echo '<div style="width:75%;margin:auto;color:#fff;font-size:15px;">
';
echo '<table class="bron_room" id="rooms_table" style="margin-bottom: 30px;">';
$date=date("d.m.Y");
echo getRooms($date,$db);
echo '</table>';
echo '<div style="margin-top: 20px;width:25%;float:left;font-size: 14px;">
<div style="width: 40%;
    float: left;
    border: 1px solid #fff;
    height: 20px;
    margin: 0px;
    text-align: center;">свободно</div>
<div class="fiol1" style="width: 40%;
    float: right;
    border: 0px solid #fff;
    height: 20px;
    padding: 2px;
    margin: 0px;
    text-align: center;">занято</div>
</div>
<div class="clr"></div>';
echo'</div>';
?>

</div>
  
		
		
</body>
</html>