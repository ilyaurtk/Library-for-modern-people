<?php
require "db.php";?>
<!DOCTYPE html>
<html lang = "ru">
<head>
     <title>Библиотека</title>
     <meta charset="UTF-8">
     <link rel="stylesheet" type="text/css" href="style.css">
     <link rel="shortcut icon" href="screens/favicon.ico" type="image/x-icon">
</head>
<?php
$label = 'ID';//получаем ID строки
$id = false;
if (  !empty( $_GET[ $label ] )  )//проверка наличия переданного id
{
  $id = $_GET[ $label ];//запись id в переменную $id

  $data = $_POST;
	if(isset($data['do_update']))//проверка нажатия кнопки Войти
	{
		$errors=array();
		if($data['uid']!=null)
		{
			if(R::count('users',"uid = ?", array($data['uid']))>0) //поиск uid в базе
			{
				$errors[]='Пользователь с таким UID уже существует';
			}
			else
			{
				$changemode = R::findOne( 'users', ' id = ? ', array($id));
				$changemode->uid = $data['uid'];
				R::store($changemode);
			}
		}
		if($data['login']!=null)
		{
			if(R::count('users',"login = ?", array($data['login']))>0) //поиск логина в базе
			{
				$errors[]='Пользователь с таким логином уже существует';
			}
			else
			{
				$changemode = R::findOne( 'users', ' id = ? ', array($id));
				$changemode->login = $data['login'];
				R::store($changemode);
			}
		}
		if($data['email']!=null)
		{
			if(R::count('users',"email = ?", array($data['email']))>0) //поиск email в базе
			{
				$errors[]='Пользователь с таким email уже существует';
			}
			else
			{
				$changemode = R::findOne( 'users', ' id = ? ', array($id));
				$changemode->email = $data['email'];
				R::store($changemode);
			}
		}
		if($data['password']!=null)
		{
			$changemode = R::findOne( 'users', ' id = ? ', array($id));
			$changemode->password = $data['password'];
			R::store($changemode);
		}
		if($data['phone']!=null)
		{
			if(R::count('users',"phone = ?", array($data['phone']))>0) //поиск телефона в базе
			{
				$errors[]='Пользователь с таким телефонным номером уже существует';
			}
			else
			{
				$changemode = R::findOne( 'users', ' id = ? ', array($id));
				$changemode->phone = $data['phone'];
				R::store($changemode);
			}
		}
		if($data['points']!=null)
		{
			$changemode = R::findOne( 'users', ' id = ? ', array($id));
			$changemode->points = $data['points'];
			R::store($changemode);
		}
		if($data['taken_books']!=null)
		{
			$changemode = R::findOne( 'users', ' id = ? ', array($id));
			$changemode->taken_books = $data['taken_books'];
			R::store($changemode);
		}
		if($data['surname']!=null)
		{
			$changemode = R::findOne( 'users', ' id = ? ', array($id));
			$changemode->surname = $data['surname'];
			R::store($changemode);
		}
		if($data['name']!=null)
		{
			$changemode = R::findOne( 'users', ' id = ? ', array($id));
			$changemode->name = $data['name'];
			R::store($changemode);
		}
		if($data['otchestvo']!=null)
		{
			$changemode = R::findOne( 'users', ' id = ? ', array($id));
			$changemode->otchestvo = $data['otchestvo'];
			R::store($changemode);
		}
		if($data['num_pass']!=null)
		{
			$changemode = R::findOne( 'users', ' id = ? ', array($id));
			$changemode->num_pass = $data['num_pass'];
			R::store($changemode);
		}
		if($data['pass_serial']!=null)
		{
			$changemode = R::findOne( 'users', ' id = ? ', array($id));
			$changemode->pass_serial = $data['pass_serial'];
			R::store($changemode);
		}
		if(empty($errors))//если ошибок нет
	{
	echo "<h1 style='color: green;'>ОК</h1>";
	}
	else
	{
		echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';//если массив ошибок не пуст, выводится записанная в массив ошибка
	}
}
	





 $rows_job = R::getAll('SELECT * FROM users WHERE id ='.$id.'');
 echo "Текущее значение поля:<br>";
  echo "<table><tr>
  		<td>UID</td>
  		<td>Логин</td>
  		<td>email</td>
  		<td>Пароль</td>
  		<td>Телефон</td>
  		<td>Баллы</td>
  		<td>Книги</td>
  		<td>Фамилия</td>
  		<td>Имя</td>
  		<td>Отчество</td>
  		<td>Номер паспорта</td>
  		<td>Серия</td>
  		</tr><tr>";
	foreach ($rows_job as $row)//цикл в котором за один проход записываются в переменную row данные ОДНОЙ строки в таблице по порядку
		{
			echo '<td>'.$row['uid'] .'</td>';
			echo '<td>'.$row['login'] .'</td>';
			echo '<td>'.$row['email'] .'</td>';
			echo '<td>'.$row['password'] .'</td>';
			echo '<td>'.$row['phone'] .'</td>';
			echo '<td>'.$row['points'] .'</td>';
			echo '<td>'.$row['taken_books'] .'</td>';
			echo '<td>'.$row['surname'] .'</td>';
			echo '<td>'.$row['name'] .'</td>';
			echo '<td>'.$row['otchestvo'] .'</td>';
			echo '<td>'.$row['num_pass'] .'</td>';
			echo '<td>'.$row['pass_serial'] .'</td>';
			echo '</tr>';
    	}
    	echo "</table>";
		echo "<br><br><table><tr>
  		<td>UID</td>
  		<td>Логин</td>
  		<td>email</td>
  		<td>Пароль</td>
  		<td>Телефон</td>
  		<td>Баллы</td>
  		<td>Книги</td>
  		<td>Фамилия</td>
  		<td>Имя</td>
  		<td>Отчество</td>
  		<td>Номер паспорта</td>
  		<td>Серия</td>
  		</tr><tr>";
		echo '<form action="user_update.php?ID='.$id.'" method="POST">';
		echo '<td><input type="text" name="uid"></td>
			  <td><input type="text" name="login"></td>
			  <td><input type="email" name="email"></td>
			  <td><input type="text" name="password"></td>
			  <td><input type="text" name="phone"></td>
			  <td><input type="text" name="points"></td>
			  <td><input type="text" name="taken_books"></td>
			  <td><input type="text" name="surname"></td>
			  <td><input type="text" name="name"></td>
			  <td><input type="text" name="otchestvo"></td>
			  <td><input type="text" name="num_pass"></td>
			  <td><input type="text" name="pass_serial"></td>
			  <td><button type="submit" name="do_update">Изменить</button></td>
			  </tr>
			  </form>';

}

?>
<div class="exit">
<a href="index.php?ID=1">Назад</a></div>