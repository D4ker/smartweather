<?php
require_once(__DIR__ . '/../../api.php');
require_once(getcwd() . '/src/php/grabber/gismeteoData.php');

$cityName = 'Saint Petersburg'; // Пока что только Санкт-Петербург

$connection = connectToDB('grabber_db');

$cityInfo = getCityInfo($connection, $cityName);

$timeZone = $cityInfo['time_zone'];
$shiftTime = time() + ($timeZone * 60 * 60);
$currentTime = date('H:i:s', $shiftTime);
echo 'Current time is ' . $currentTime . '<br>';

$cityID = $cityInfo['id'];

// Gismeteo
$gismeteoData = getGismeteoData();
printData($gismeteoData[0]);
printData($gismeteoData[1]);
printData($gismeteoData[2]);
printData($gismeteoData[3]);

$tableName = 'gismeteo_today_data';
deleteOldData($connection, $tableName, $cityID);
for ($time = 0, $i = 0; $time < 24; $time += 3, $i++) {
	// $cityID, $time, $temperature, $windValue, $windDirection, $humidity
	updateDataInTable($connection, $tableName, $cityID, $time, $gismeteoData[0][$i], $gismeteoData[1][$i], $gismeteoData[2][$i], $gismeteoData[3][$i]);
}

closeConnection($connection);
?>