<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Smart Weather</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
	<link rel="stylesheet" href="src/css/style.css" type="text/css">
</head>
<body>
	<?php
	require_once('src/php/fileConnector.php');
	?>

	<div class="container-header">
		<div class="container-title">
			<a class="title-field" href="">Smart Weather</a>
		</div>
		<div class="container-panel">
			<a class="panel-button" href="">Вход/Регистрация</a>
		</div>
	</div>
	<div class="container">
		<div class="container-left">
			
		</div>
		<div class="container-center">
			<div class="day-menu">
				<input class="day-button" type="button" value="Вчера" onclick="">
				<input class="day-button" type="button" value="Сегодня" onclick="">
			</div>
			<div class="weather-data">
				<p id="weather-data-text">time</p>
			</div>
		</div>
		<div class="container-right">
			<input class="site-button" type="button" value="Gismeteo.com" onclick="">
			<input class="site-button" type="button" value="Weather.com" onclick="">
		</div>
	</div>

	<script src="src/js/main.js"></script>

	<script>
		init(<?php echo $json; ?>);
	</script>

</body>
</html>