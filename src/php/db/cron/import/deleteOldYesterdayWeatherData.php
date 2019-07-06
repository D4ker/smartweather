<?php
// Удаление осуществляется каждые 24 часа

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

$tableName = 'weather_yesterday_data';
ApiDB::deleteOldData($connection, $tableName, $cityID);

ApiDB::closeConnection($connection);
?>