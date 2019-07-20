<?php
require_once(__DIR__ . '/../../db/ApiDB.php');

$data = $_POST;

$errors = array();
$password = $data['password'];
if (!isset($_SESSION['logged_user'])) {
	if (isset($data['sign-in'])) {
		$login = $data['login-in'];
		if ($login == '') {
			$errors[] = 'Введите логин';
		}

		if ($password == '') {
			$errors[] = 'Введите пароль';
		}

		if (empty($errors)) {
			$user = ApiDB::authorization($login, $password);
			if ($user != false) {
				$_SESSION['logged_user'] = $user;
			} else {
				echo '<div style="color: red;">Логин или пароль введены неверно</div><hr>';
			}
		} else {
			echo '<div style="color: red;">' . array_shift($errors) . '</div><hr>';
		}
	} else if (isset($data['sign-up'])) {
		$login = $data['login-up'];
		if ($login == '') {
			$errors[] = 'Введите логин';
		}

		if (strpos($login, ' ') !== false) {
			$errors[] = 'Логин не допускает использование пробельных символов';
		}

		if (strlen($login) > 15) {
			$errors[] = 'Логин не может быть больше 15 символов';
		}

		if ($password == '') {
			$errors[] = 'Введите пароль';
		}

		if ($data['password-confirm'] != $password) {
			$errors[] = 'Пароли не совпадают';
		}

		if (empty($errors)) {
			$checkAuthorization = ApiDB::createAccount($login, $password);
			if ($checkAuthorization != false) {
				echo '<div style="color: green;">Регистрация прошла успешно</div><hr>';
			} else {
				echo '<div style="color: red;">Пользователь с таким именем уже существует</div><hr>';
			}
		} else {
			echo '<div style="color: red;">' . array_shift($errors) . '</div><hr>';
		}
	}
}
?>