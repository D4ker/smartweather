<?php
require_once('parser.php');
require_once('userAgentHeaderReplacing.php');

function parseValuesToArrays($values) {
	$i = 0;
	$j = 0;
	$arrays = array(
		array(),
		array(),
		array(),
		array(),
		array()
	);
	foreach ($values as $value) {
		$arrays[$i][$j] = $value;
		if ($i < 4) {
			$i++;
		} else {
			$i = 0;
			$j++;
		}
	}
	return $arrays;
}

echo '<br>Weather temperature:<br>';

$siteInfo = array(
	'url' => 'https://www.weather.com/ru-RU/weather/hourbyhour/l/4edb4827c7f66b1542f84ce1d8d644970e9b935d45d21d4d143e87d94925a4bf',
	'data' => array(
		'data_with_tags' => array(
			'start' => '<tbody>',
			'end' => '</tbody>',
		),
		'values' => array(
			'start' => '<span class="">',
			'end' => '</span>'
		),
		'time' => array(
			'start' => '<span class="dsx-date">',
			'end' => '</span>'
		),
	),
);

$context = getContext();
$siteHtml = file_get_contents($siteInfo['url'], false, $context);

$arraysOfValues = parseValuesToArrays(getData($siteHtml, $siteInfo['data'], 'values'));

$arrayOfTemperatures = $arraysOfValues[0]; // Температура
$arrayOfTempFeels = $arraysOfValues[1]; // Ощущается
$arrayOfPrecips = $arraysOfValues[2]; // Осадки
$arrayOfHumiditys = $arraysOfValues[3]; // Влажность
$arrayOfWinds = $arraysOfValues[4]; // Ветер

$arrayOfTimes = getData($siteHtml, $siteInfo['data'], 'time'); // Время

printData($arrayOfTimes);
printData($arrayOfTemperatures);
printData($arrayOfTempFeels);
printData($arrayOfPrecips);
printData($arrayOfHumiditys);
printData($arrayOfWinds);

?>