<?php
require_once(__DIR__ . '/../../ApiDB.php');
require_once(getcwd() . '/src/php/grabber/GismeteoData.php');
require_once(getcwd() . '/src/php/grabber/WeatherData.php');

$cityName = 'Saint Petersburg'; // Пока что только Санкт-Петербург

$connection = ApiDB::connectTo('grabber_db');

$cityInfo = ApiDB::getCityInfo($connection, $cityName);

$timeZone = $cityInfo['time_zone'];
$shiftTime = time() + ($timeZone * 60 * 60);
$currentTime = date('H:i:s', $shiftTime);
echo 'Current time is ' . $currentTime . '<br>';

$cityID = $cityInfo['id'];

// Gismeteo
$gismeteoData = GismeteoData::getData();
GismeteoData::printData($gismeteoData[0]);
GismeteoData::printData($gismeteoData[1]);
GismeteoData::printData($gismeteoData[2]);
GismeteoData::printData($gismeteoData[3]);

$tableName = 'gismeteo_today_data';
ApiDB::deleteOldData($connection, $tableName, $cityID);
for ($time = 0, $i = 0; $time < 24; $time += 3, $i++) {
	// $cityID, $time, $temperature, $windValue, $windDirection, $humidity
	ApiDB::updateDataInTable($connection, $tableName, $cityID, $time, $gismeteoData[0][$i], $gismeteoData[1][$i], $gismeteoData[2][$i], $gismeteoData[3][$i]);
}

// Weather
$weatherData = WeatherData::getData();
WeatherData::printData($weatherData[0]);
WeatherData::printData($weatherData[1]);
WeatherData::printData($weatherData[2]);
WeatherData::printData($weatherData[3]);

$tableName = 'weather_today_data';
ApiDB::deleteOldData($connection, $tableName, $cityID);
for ($time = (int)($currentTime), $i = 0; $time <= count($weatherData[0]); $time++, $i++) {
	// $cityID, $time, $temperature, $windValue, $windDirection, $humidity
	ApiDB::updateDataInTable($connection, $tableName, $cityID, $time, $weatherData[0][$i], $weatherData[1][$i], $weatherData[2][$i], $weatherData[3][$i]);
}

ApiDB::closeConnection($connection);
?>