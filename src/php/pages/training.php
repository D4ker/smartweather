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
		<div class="container-left">
			<div class="container-left-up">
				<h2>Что Вы бы хотели сделать?</h2>
				<input class="table-button" type="button" value="Обучить" onclick="printTable(0);">
				<input class="table-button" type="button" value="Добавить одежду" onclick="printTable(1);">
			</div>
			<div class="container-left-down">
				<div class="add-record">
					<form action="/src/php/pages/training.php" method="POST">
						<h2>Добавить запись в таблицу</h2>
						<div class="list">
							<p class="list-name">Город</p>
							<select id="city" name="city">
							
							</select>
						</div>
						<div class="list">
							<p class="list-name">Время</p>
							<select id="time" name="time">
							
							</select>
						</div>
						<div class="list">
							<p class="list-name">Tемпература,&nbsp;°C</p>
							<input type="text" name="temperature" placeholder="Введите температуру">
						</div>
						<div class="list">
							<p class="list-name">Ветер, м/с</p>
							<input type="text" name="wind-value" placeholder="Введите скорость ветра">
						</div>
						<div class="list">
							<p class="list-name">Направление ветра</p>
							<select id="wind-direction" name="wind-direction">
							
							</select>
						</div>
						<div class="list">
							<p class="list-name">Влажность, %</p>
							<input type="text" name="humidity" placeholder="Введите влажность">
						</div>
						<div class="list">
							<p class="list-name">Одежда</p>
							<select id="clothes" name="clothes">
							
							</select>
						</div>
						<button type="submit" name="add-record">Добавить</button>
					</form>
				</div>
			</div>
		</div>
		<div class="container-right">
			<table>
				<thead id="data-head">
					<tr>
						<th>Город</th>
						<th>Время</th>
						<th>Tемпература,&nbsp;°C</th>
						<th>Ветер, м/с</th>
						<th>Направление ветра</th>
						<th>Влажность, %</th>
						<th>Одежда</th>
					</tr>
				</thead>
				<tbody id="data">
					
				</tbody>
			</table>
		</div>
	</div>

	<script src="../../js/training.js"></script>

	<script>
		updateData(<?php echo $json; ?>);
	</script>
</body>
</html>