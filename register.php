<?php require "db.php"; ?>
<!DOCTYPE html>
<html style="background:linear-gradient(120deg, #FFD692, #E16363); height:100%;" lang = "ru">
<head>
     <title>Библиотека</title>
     <meta charset="UTF-8">
     <link rel="stylesheet" type="text/css" href="style.css">
     <link rel="shortcut icon" href="screens/favicon.ico" type="image/x-icon">
</head>
<body>
	
<?php

$data = $_POST;//данные, переданные из формы передаются в переменную
if(isset($data['do_signup']))//если была нажата кнопка ЗАРЕГИСТРИРОВАТЬСЯ
{
	$errors = array();// запись ошибок в массив
	if(trim($data['login']) == '')//проверка на существование логина
	{
		$errors[]='Введите логин';//запись ошибки в массив
	}
	if($data['password'] == '')//проверка на существование пароля
	{
		$errors[]='Введите пароль';
	}
	if(trim($data['email']) == '')//проверка на существование email
	{
		$errors[]='Введите email';
	}
	if(R::count('users',"login = ?", array($data['login']))>0) //поиск логина в базе
	{
		$errors[]='Пользователь с таким логином уже существует';
	}
	if(R::count('users',"email = ?", array($data['email']))>0) //поиск email в базе
	{
		$errors[]='Пользователь с таким email уже существует';
	}
	if($data['password2'] != $data['password'])//Проверка на правильность написания второго пароля
	{
		$errors[]='Пароли не совпадают';
	}
	
	if(empty($errors))//если ошибок нет
	{
		$user = R::dispense('users');//создает таблицу users с полем id + autoincrement поля id
		$user->login=$data['login'];
		$user->email=$data['email'];
		$user->password=$data['password'];//шифровка пароля
		$user->uid=$data['uid'];
		$user->phone=$data['phone'];
		$user->points=0;
		$user->taken_books=0;
		$user->surname=0;
		$user->name=0;
		$user->otchestvo=0;
		$user->num_pass=0;
		$user->pass_serial=0;
		R::store($user);// сохраняет объект $user в таблице 
		header('Refresh: 5;/login.php');
	}}

?>

<div class="img"></div>
<div class="form">
<center>Регистрация</center><hr><br>
<form action="/register.php" method="POST">
	Логин:<br> 
	<input type="text" name="login" value="<?php echo @$data['login'];?>"><br><br>
	Пароль: <br>
	<input type="password" name="password"><br><br>
	Пароль ещё раз: <br>
	<input type="password" name="password2"><br><br>
	email: <br>
	<input type="email" name="email" value="<?php echo @$data['email'];?>"><br><br>
	Номер вашей карты: <br>
	<input type="text" name="uid"><br><br>
	Ваш номер телефона: <br>
	<input type="text" name="phone"><br><br>
	<button type="submit" name="do_signup">Зарегистрироваться</button><br><br>
	<?php
	if(! empty($errors))
	{
		echo '<div style="color: red;">'.array_shift($errors).'</div>';//если массив ошибок не пуст, выводится записанная в массив ошибка
	}
	else if( empty($errors) && (isset($data['do_signup']))) 
	{
		echo '<div style="color: green;">Регистрация прошла успешно</div>';
	}
	?>
	<button type="submit" name="go">Я уже зарегистрирован</button>
	<?php 
	if(isset($data['go']))
	{
		header('Location: login.php');
	}
	?>
</form>
</div>
</body>
</html>