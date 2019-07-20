<?php
// Экспорт осуществляется при обновлении страницы
require_once(__DIR__ . '/../../../init/session.php');
require_once(__DIR__ . '/../../ApiDB.php');

$connection = ApiDB::connectTo('grabber_db');

// Cities
$tableName = 'cities';
$cities = ApiDB::getTableData($connection, $tableName);

ApiDB::closeConnection($connection);

$connection = ApiDB::connectTo('training_db');

$userId = $_SESSION['logged_user']['id'];

// Clothes
$tableName = 'user_clothes';
$clothes = ApiDB::getDataTableByFieldValue($connection, $tableName, 'user_id', $userId);

// Base data
$tableName = 'base_data';
$baseData = ApiDB::getTableData($connection, $tableName);

// User data
$tableName = 'user_data';
$userData = ApiDB::getDataTableByFieldValue($connection, $tableName, 'user_id', $userId);

// Categories
$tableName = 'clothes_category';
$categories = ApiDB::getTableData($connection, $tableName);

$data = array(
	'cities' => $cities,
	'user_clothes' => $clothes,
	'base_data' => $baseData,
	'user_data' => $userData,
	'clothes_category' => $categories
);
$json = json_encode($data);

ApiDB::closeConnection($connection);
?>