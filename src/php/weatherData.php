<?php
require_once("src/php/parser.php");

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
	'tags' => array(
		'start' => '<tbody>',
		'end' => '</tbody>',
		'values_tags' => array(
			'start' => '<span class="">',
			'end' => '</span>'
		),
		'time_values_tags' => array(
			'start' => '<span class="dsx-date">',
			'end' => '</span>'
		),
	),
);

$context = stream_context_create(
	array(
		"http" => array(
			"header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
		)
	)
);

$siteHtml = file_get_contents($siteInfo['url'], false, $context);
$siteTags = $siteInfo['tags'];
$dataWithTags = parseWithTags($siteHtml, $siteTags['start'], $siteTags['end']);

$siteValuesTags = $siteTags['values_tags'];
$values = parse($dataWithTags, $siteValuesTags['start'], $siteValuesTags['end']);
if ($values[1] == 1) {
	echo 'DATA ERROR 1<br>';
}

$arraysOfValues = parseValuesToArrays($values[0]);

$arrayOfTemperatures = $arraysOfValues[0]; // Температура
$arrayOfTempFeels = $arraysOfValues[1]; // Ощущается
$arrayOfPrecips = $arraysOfValues[2]; // Осадки
$arrayOfHumiditys = $arraysOfValues[3]; // Влажность
$arrayOfWinds = $arraysOfValues[4]; // Ветер

$siteTimeValuesTags = $siteTags['time_values_tags'];
$arrayOfTimes = parse($dataWithTags, $siteTimeValuesTags['start'], $siteTimeValuesTags['end']); // Время
if ($arrayOfTimes[1] == 1) {
	echo 'DATA ERROR 2<br>';
}

foreach ($arrayOfTimes[0] as $time) {
	echo $time . ' ';
}
echo '<br>';

foreach ($arrayOfTemperatures as $value) {
	echo $value . ' ';
}
echo '<br>';

foreach ($arrayOfTempFeels as $value) {
	echo $value . ' ';
}
echo '<br>';

foreach ($arrayOfPrecips as $value) {
	echo $value . ' ';
}
echo '<br>';

foreach ($arrayOfHumiditys as $value) {
	echo $value . ' ';
}
echo '<br>';

foreach ($arrayOfWinds as $value) {
	echo $value . ' ';
}
echo '<br>';

?>