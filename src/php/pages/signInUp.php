<?php

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Вход/Регистрация</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
</head>
<body>
	<div class="container">
		<form action="/src/php/pages/signInUp.php" method="POST">
			<h2>Вход</h2>
			<input type="text" name="login" placeholder="Введите логин">
			<input type="password" name="password" placeholder="Введите пароль">
		</form>
		<form action="/src/php/pages/signInUp.php" method="POST">
			<h2>Регистрация</h2>
			<input type="text" name="login" placeholder="Введите логин">
			<input type="password" name="password" placeholder="Введите пароль">
			<input type="password" name="password-confirm" placeholder="Введите пароль ещё раз">
		</form>
	</div>
</body>
</html>