<?php
// Импорт осуществляется каждые 15 минут

require_once(__DIR__ . '/../../ApiDB.php');
require_once(getcwd() . '/src/php/grabber/GismeteoData.php');
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

// Gismeteo
$gismeteoData = GismeteoData::getData();
/* Отладка
GismeteoData::printData($gismeteoData[0]);
GismeteoData::printData($gismeteoData[1]);
GismeteoData::printData($gismeteoData[2]);
GismeteoData::printData($gismeteoData[3]);
*/

$tableName = 'gismeteo_today_data';
$gismeteoTime = array(0, 3, 6, 9, 12, 15, 18, 21);
// $cityID, $time, $temperature, $windValue, $windDirection, $humidity
ApiDB::updateDataInTable($connection, $tableName, $cityID, $gismeteoTime, $gismeteoData[0], $gismeteoData[1], $gismeteoData[2], $gismeteoData[3]);

// Weather
$weatherData = WeatherData::getData();
/* Отладка
WeatherData::printData($weatherData[0]);
WeatherData::printData($weatherData[1]);
WeatherData::printData($weatherData[2]);
WeatherData::printData($weatherData[3]);
WeatherData::printData($weatherData[4]);
*/

$tableName = 'weather_today_data';
ApiDB::updateDataInTable($connection, $tableName, $cityID, $weatherData[0], $weatherData[1], $weatherData[2], $weatherData[3], $weatherData[4]);

ApiDB::closeConnection($connection);
?>