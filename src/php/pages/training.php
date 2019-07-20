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
		<div class="add-record">
			<form action="/src/php/pages/training.php" method="POST">
				<h2>Добавить запись в таблицу</h2>
				<select name="city">
					<option>Выберете город</option>
					<div id="city">
						
					</div>
				</select>
				<select name="time">
					<option>Выберете время</option>
					<div id="time">
						
					</div>
				</select>
				<input type="text" name="temperature" placeholder="Введите температуру">
				<input type="text" name="wind-value" placeholder="Введите скорость ветра">
				<select name="wind-direction">
					<option>Выберете направление ветра</option>
					<div id="wind-direction">
						
					</div>
				</select>
				<input type="text" name="humidity" placeholder="Введите влажность">
				<select name="clothes">
					<option>Выберете одежду</option>
					<div id="clothes">
						
					</div>
				</select>
				<button type="submit" name="add-record">Добавить</button>
			</form>
		</div>
	</div>

	<script src="../../js/training.js"></script>

	<script>
		updateSelections(<?php echo $arrayOfCities; ?>, <?php echo $arrayOfClothes; ?>);
		updateTables(<?php echo $baseData; ?>, <?php echo $userData; ?>);
		updateCategories(<?php echo $categories; ?>);
	</script>
</body>
</html>