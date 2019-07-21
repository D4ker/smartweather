<?php
// Импорт осуществляется по нажатию на кнопку "Добавить"

require_once(__DIR__ . '/../init/session.php');
require_once(__DIR__ . '/../db/ApiDB.php');

$connection = ApiDB::connectTo('training_db');

$data = $_POST;

$errors = array();
if (isset($data['add-training-record'])) {

	// Здесь надо добавить проверки на некорректность введённых данных

	if (empty($errors)) {
		// Добавление данных

		echo '<div style="color: green;">Данные успешно добавлены в таблицу "Обучение"</div><hr>'; 
	} else {
		echo '<div style="color: red;">' . array_shift($errors) . '</div><hr>';
	}
} else if (isset($data['add-clothes-record'])) {

	// Здесь надо (хотя вряд ли!) добавить проверки на некорректность введённых данных

	if (empty($errors)) {
		// Добавление данных

		echo '<div style="color: green;">Данные успешно добавлены в таблицу "Одежда"</div><hr>';
	} else {
		echo '<div style="color: red;">' . array_shift($errors) . '</div><hr>';
	}
}

ApiDB::closeConnection($connection);
?>