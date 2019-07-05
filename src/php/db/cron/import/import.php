<?php
require_once(__DIR__ . '/../../api.php');

$cityName = 'Saint Petersburg'; // Пока что только Санкт-Петербург

$connection = connectToDB('grabber_db');

$cityInfo = getCityInfo($connection, $cityName);

$timeZone = $cityInfo['time_zone'];
$shiftTime = time() + ($timeZone * 60 * 60);
echo 'Current time is ' . date('H:i:s', $shiftTime) . '<br>';

// $cityID, $time, $temperature, $windValue, $windDirection, $humidity
//addDataToTable($connection, 'gismeteo_today_data', );

closeConnection($connection);
?>