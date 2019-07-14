<?php
// Экспорт осуществляется при обновлении страницы

require_once(__DIR__ . '/../../ApiDB.php');

$cityName = 'Saint Petersburg'; // Пока что только Санкт-Петербург

$connection = ApiDB::connectTo('grabber_db');

$cityInfo = ApiDB::getCityInfo($connection, $cityName);

// Пока что не используется, так как пока что реализация только для одного города
$timeZone = $cityInfo['time_zone'];
$shiftTime = time() + ($timeZone * 60 * 60);
$currentTime = date('H:i:s', $shiftTime);
// echo 'Current time is ' . $currentTime . '<br>'; Отладка

$cityID = $cityInfo['id'];

// Gismeteo Today
$tableName = 'gismeteo_today_data';
$gismeteoTodayData = ApiDB::getDataFromTable($connection, $tableName, $cityID);

// Gismeteo Yesterday
$tableName = 'gismeteo_yesterday_data';
$gismeteoYesterdayData = ApiDB::getDataFromTable($connection, $tableName, $cityID);

// Weather Today
$tableName = 'weather_today_data';
$weatherTodayData = ApiDB::getDataFromTable($connection, $tableName, $cityID);

// Weather Yesterday
$tableName = 'weather_yesterday_data';
$weatherYesterdayData = ApiDB::getDataFromTable($connection, $tableName, $cityID);

$data = array(
	'gismeteo_today_data' => $gismeteoTodayData,
	'gismeteo_yesterday_data' => $gismeteoYesterdayData,
	'weather_today_data' => $weatherTodayData,
	'weather_yesterday_data' => $weatherYesterdayData
);
$json = json_encode($data);

ApiDB::closeConnection($connection);
?>