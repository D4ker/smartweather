<?php
// Импорт осуществляется каждый час

require_once(__DIR__ . '/../../ApiDB.php');
require_once(getcwd() . '/src/php/grabber/WeatherData.php');

$cityName = 'Saint Petersburg'; // Пока что только Санкт-Петербург

$connection = ApiDB::connectTo('grabber_db');

$cityInfo = ApiDB::getCityInfo($connection, $cityName);

// Пока что не используется, так как пока что реализация только для одного города
$timeZone = $cityInfo['time_zone'];
$shiftTime = time() + ($timeZone * 60 * 60);
$currentTime = date('H:i:s', $shiftTime);
// echo 'Current time is ' . $currentTime . '<br>'; Отладка

$cityID = $cityInfo['id'];

// Weather
$weatherData = WeatherData::getData();
/* Отладка
WeatherData::printData($weatherData[0]);
WeatherData::printData($weatherData[1]);
WeatherData::printData($weatherData[2]);
WeatherData::printData($weatherData[3]);
WeatherData::printData($weatherData[4]);
*/

$tableName = 'weather_yesterday_data';
ApiDB::updateDataInTable($connection, $tableName, $cityID, $weatherData[0], $weatherData[1], $weatherData[2], $weatherData[3], $weatherData[4]);

ApiDB::closeConnection($connection);
?>