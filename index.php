<?php
	require_once('src/php/fileConnector.php');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Smart Weather</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
	<link rel="stylesheet" href="src/css/style.css" type="text/css">
</head>
<body>
	<div class="container-header">
		<div class="container-title">
			<a class="title-field" href="">Smart Weather</a>
		</div>
		<div class="container-panel">
			<?php if (!isset($_SESSION['logged_user'])) : ?>
				<a class="panel-button" href="/src/php/pages/signInUp.php">Вход/Регистрация</a>
			<?php else : ?>
				<a class="panel-button" href="/src/php/pages/trainingSettings.php">Обучение</a>
				<a class="panel-button" href="/src/php/pages/logout.php">Выйти</a>
			<?php endif; ?>
		</div>
	</div>
	<div class="container">
		<div class="container-left">
			
		</div>
		<div class="container-center">
			<div class="day-menu">
				<input class="day-button" type="button" value="Вчера" onclick="printData(-1)">
				<input class="day-button" type="button" value="Сегодня" onclick="printData(0)">
			</div>
			<div id="weather-data">
				<table>
					<thead id="data-head">
						<tr>
							<th class="time-head">Время</th>
							<th class="temperature-head">Tемпература,&nbsp;°C</th>
							<th class="wind-value-head">Ветер, м/с</th>
							<th class="wind-direction-head">Направление ветра</th>
							<th class="humidity-head">Влажность, %</th>
						</tr>
					</thead>
					<tbody id="data">

					</tbody>
				</table>
			</div>
		</div>
		<div class="container-right">
			<input class="site-button" type="button" value="Gismeteo.com" onclick="setSite('gismeteo')">
			<input class="site-button" type="button" value="Weather.com" onclick="setSite('weather')">
		</div>
	</div>

	<script src="src/js/main.js"></script>

	<script>
		updateData(<?php echo $json; ?>);
	</script>

</body>
</html>