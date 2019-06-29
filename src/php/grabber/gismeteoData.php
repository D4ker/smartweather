<?php
require_once("parser.php");
require_once("userAgentHeaderReplacing.php");

function printData($arrayOfData) {
	foreach ($arrayOfData as $value) {
		echo $value . ' ';
	}
	echo '<br>';
}

echo 'Hello World!<br>';
echo "Current date is ";
echo date('d.m.Y') . '<br>';
echo 'Gismeteo temperature:<br>';

$siteInfo = array(
	'url' => 'https://www.gismeteo.ru/city/hourly/4079/',
	'temp' => array(
		'data_with_tags' => array(
			'start' => '<div class="templine w_temperature">',
			'end' => '</span></div></div>'
		),
		'values' => array(
			'start' => '<span class="unit unit_temperature_c">',
			'end' => '</span>'
		),
	),
	'wind' => array(
		'data_with_tags' => array(
			'start' => '<div class="widget__row widget__row_table widget__row_wind">',
			'end' => '<div class="widget__type widget__type_gust">'
		),
		'values' => array(
			'start' => '<span class="unit unit_wind_m_s">',
			'end' => '</span>'
		),
		'directions' => array(
			'start' => '<div class="w_wind__direction gray">',
			'end' => '</div>'
		),
	),
	'humidity' => array(
		'data_with_tags' => array(
			'start' => '<div class="widget__row widget__row_table widget__row_humidity">',
			'end' => '<div class="widget__footer">'
		),
		'values' => array(
			'start' => '<div class="widget__item">',
			'end' => '</div>'
		),
	),
);

$context = getContext();
$siteHtml = file_get_contents($siteInfo['url'], false, $context);

$arrayOfTemperatures = getData($siteHtml, $siteInfo['temp'], 'values'); // Температура
$arrayOfWindsValues = getData($siteHtml, $siteInfo['wind'], 'values'); // Ветер
$arrayOfWindsDirections = getData($siteHtml, $siteInfo['wind'], 'directions'); // Направление ветра
$arrayOfHumiditys = getData($siteHtml, $siteInfo['humidity'], 'values'); // Влажность

printData($arrayOfTemperatures);
printData($arrayOfWindsValues);
printData($arrayOfWindsDirections);
printData($arrayOfHumiditys);

?>