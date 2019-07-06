<?php
// Импорт осуществляется каждый час

require_once(__DIR__ . '/../../ApiDB.php');
require_once(getcwd() . '/src/php/grabber/GismeteoData.php');

$cityName = 'Saint Petersburg'; // Пока что только Санкт-Петербург

$connection = ApiDB::connectTo('grabber_db');

$cityInfo = ApiDB::getCityInfo($connection, $cityName);

// Пока что не используется, так как пока что реализация только для одного города
$timeZone = $cityInfo['time_zone'];
$shiftTime = time() + ($timeZone * 60 * 60);
$currentTime = date('H:i:s', $shiftTime);

$cityID = $cityInfo['id'];

$gismeteoData = GismeteoData::getData();

$tableName = 'gismeteo_yesterday_data';
$gismeteoTime = array(0, 3, 6, 9, 12, 15, 18, 21);
// $cityID, $time, $temperature, $windValue, $windDirection, $humidity
ApiDB::updateDataInTable($connection, $tableName, $cityID, $gismeteoTime, $gismeteoData[0], $gismeteoData[1], $gismeteoData[2], $gismeteoData[3]);

ApiDB::closeConnection($connection);
?>