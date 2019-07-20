<?php
require_once(__DIR__ . '/../init/session.php');
require_once(__DIR__ . '/../db/ApiDB.php');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Обучение</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
	<link rel="stylesheet" href="../../css/training.css" type="text/css">
</head>
<body>
	<div class="container-header">
		<div class="container-panel">
			<a class="panel-button" href="/">Вернуться на главную</a>
		</div>
	</div>
	<div class="container">
		<div class="new-record">
			<form action="/src/php/pages/training.php" method="POST">
				<h2>Добавить запись в таблицу</h2>
				<select name="city">
					<option>Выберете город</option>
					<div class="city">
						
					</div>
				</select>
				<select name="time">
					<option>Выберете время</option>
					<div class="time">
						
					</div>
				</select>
				<input type="text" name="temperature" placeholder="Введите температуру">
				<input type="text" name="temperature" placeholder="Введите скорость ветра">
				<select name="wind_direction">
					<option>Выберете направление ветра</option>
					<div class="wind_direction">
						
					</div>
				</select>
				<input type="text" name="humidity" placeholder="Введите влажность">
				<select name="clothes">
					<option>Выберете одежду</option>
					<div class="clothes">
						
					</div>
				</select>
				<button type="submit" name="sign-in">Добавить</button>
			</form>
		</div>
	</div>
</body>
</html>