<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Вход/Регистрация</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
	<link rel="stylesheet" href="../../css/signInUp.css" type="text/css">
</head>
<body>
	<?php
	require_once(__DIR__ . '/../training/accounts/createAccount.php');
	?>

	<div class="container">
		<div class="sign-in">
			<form action="/src/php/pages/signInUp.php" name="d" method="POST">
				<h2>Вход</h2>
				<input type="text" name="login-in" placeholder="Введите логин" value="<?php echo @$data['login-in']; ?>">
				<input type="password" name="password" placeholder="Введите пароль">
				<button type="submit" name="sign-in">Войти</button>
			</form>
		</div>
		<div class="sign-up">
			<form action="/src/php/pages/signInUp.php" name="g" method="POST">
				<h2>Регистрация</h2>
				<input type="text" name="login-up" placeholder="Введите логин" value="<?php echo @$data['login-up']; ?>">
				<input type="password" name="password" placeholder="Введите пароль">
				<input type="password" name="password-confirm" placeholder="Введите пароль ещё раз">
				<button type="submit" name="sign-up">Зарегистрироваться</button>
		</form>
		</div>
	</div>
</body>
</html>