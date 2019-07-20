<?php
require_once(__DIR__ . '/../init/session.php');
require_once(__DIR__ . '/../db/cron/export/exportTrainingData.php');
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
		<div class="add-record">
			<form action="/src/php/pages/training.php" method="POST">
				<h2>Добавить запись в таблицу</h2>
				<select id="city" name="city">
					
				</select>
				<select id="time" name="time">
					
				</select>
				<input type="text" name="temperature" placeholder="Введите температуру">
				<input type="text" name="wind-value" placeholder="Введите скорость ветра">
				<select id="wind-direction" name="wind-direction">
					
				</select>
				<input type="text" name="humidity" placeholder="Введите влажность">
				<select id="clothes" name="clothes">
					
				</select>
				<button type="submit" name="add-record">Добавить</button>
			</form>
		</div>
	</div>

	<script src="../../js/training.js"></script>

	<script>
		updateData(<?php echo $json; ?>);
	</script>
</body>
</html>