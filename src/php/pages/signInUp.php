<?php
require_once(__DIR__ . '/../init/session.php');
require_once(__DIR__ . '/../training/accounts/loginCreateAccount.php');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Вход/Регистрация</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
	<link rel="stylesheet" href="../../css/signInUp.css" type="text/css">
</head>
<body>
	<div class="container">
		<?php if (!isset($_SESSION['logged_user'])) : ?>
			<div class="sign-in">
				<form action="/src/php/pages/signInUp.php" method="POST">
					<h2>Вход</h2>
					<input type="text" name="login-in" placeholder="Введите логин" value="<?php echo @$data['login-in']; ?>">
					<input type="password" name="password" placeholder="Введите пароль">
					<button type="submit" name="sign-in">Войти</button>
				</form>
			</div>
			<div class="sign-up">
				<form action="/src/php/pages/signInUp.php" method="POST">
					<h2>Регистрация</h2>
					<input type="text" name="login-up" placeholder="Введите логин" value="<?php echo @$data['login-up']; ?>">
					<input type="password" name="password" placeholder="Введите пароль">
					<input type="password" name="password-confirm" placeholder="Введите пароль ещё раз">
					<button type="submit" name="sign-up">Зарегистрироваться</button>
				</form>
			</div>
		<?php else : ?>
			<div class="go-back">
				<p>Вы авторизованы как <?php echo $_SESSION['logged_user']['login'] ?>. Можете вернуться на главную страницу.</p>
				<a class="back-button" href="/">На главную</a>
			</div>
		<?php endif; ?>
	</div>
</body>
</html>