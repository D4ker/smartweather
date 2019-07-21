<?php
// Импорт осуществляется по нажатию на кнопку "Добавить"

require_once(__DIR__ . '/../init/session.php');
require_once(__DIR__ . '/../db/ApiDB.php');

$connection = ApiDB::connectTo('training_db');

$data = $_POST;

$errors = array();
if (isset($data['add-training-record'])) {
	$cityID = $data['city'];
	$time = $data['time'];
	$temperature = $data['temperature'];
	$windValue = $data['wind-value'];
	$windDirection = $data['wind-direction'];
	$humidity = $data['humidity'];
	$clothesID = $data['clothes'];

	// Здесь надо добавить проверки на некорректность введённых данных

	if (empty($errors)) {
		ApiDB::addRecordInTableUserTraining($connection, $_SESSION['logged_user']['id'], $cityID, $time, $temperature, $windValue, $windDirection, $humidity, $clothesID);
		echo '<div style="color: green;">Данные успешно добавлены в таблицу "Обучение"</div><hr>'; 
	} else {
		echo '<div style="color: red;">' . array_shift($errors) . '</div><hr>';
	}
} else if (isset($data['add-clothes-record'])) {
	$clothesName = $data['clothes'];
	$categoryID = $data['category'];

	// Здесь надо (хотя вряд ли!) добавить проверки на некорректность введённых данных

	if (empty($errors)) {
		ApiDB::addRecordInTableUserClothes($connection, $_SESSION['logged_user']['id'], $clothesName, $categoryID);
		echo '<div style="color: green;">Данные успешно добавлены в таблицу "Одежда"</div><hr>';
	} else {
		echo '<div style="color: red;">' . array_shift($errors) . '</div><hr>';
	}
}

ApiDB::closeConnection($connection);
?>