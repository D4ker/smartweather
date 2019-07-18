<?php
require_once(__DIR__ . '/../../db/ApiDB.php');

$data = $_POST;

$errors = array();
$password = $data['password'];
if (isset($data['sign-in'])) {
	$login = $data['login-in'];
	if ($login != 'admin' or $password != 'admin') {
		$errors[] = 'Логин или пароль введены неверно';
	}

	if (empty($errors)) {

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

	if ($password == '') {
		$errors[] = 'Введите пароль';
	}

	if ($data['password-confirm'] != $password) {
		$errors[] = 'Пароли не совпадают';
	}

	if (empty($errors)) {
		$accountCreated = ApiDB::createAccount($login, $password);
		if ($accountCreated != false) {

		} else {
			
		}
	} else {
		echo '<div style="color: red;">' . array_shift($errors) . '</div><hr>';
	}
}
?>