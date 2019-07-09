<?php
// Вырезание (копирование с последующим удалением) осуществляется каждые 24 часа

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

$cutTableName = 'temp_weather_yesterday_data';
$insertTableName = 'weather_yesterday_data';
ApiDB::cutDataToAnotherTable($connection, $cutTableName, $insertTableName, $cityID);

ApiDB::closeConnection($connection);
?>