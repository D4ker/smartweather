<?php
require_once('SiteData.php');
require_once('Parser.php');

class GismeteoData extends SiteData {
	private static $siteInfo = array(
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

	private function refactorArrays($arraysOfValues) {
		$stringArrayOfWindDirection = array (
			'С', 'СВ', 'В', 'ЮВ', 'Ю', 'ЮЗ', 'З', 'СЗ'
		);

		for ($i = 0; $i < count($arraysOfValues[0]); $i++) {
			$stringTempValue = $arraysOfValues[0][$i];
			if ($stringTempValue[0] == '+') {
				$stringTempValue = substr($stringTempValue, 1);
			}
			$arraysOfValues[0][$i] = (int)($stringTempValue); // Температура
			$arraysOfValues[1][$i] = (int)($arraysOfValues[1][$i]); // Ветер
			$arraysOfValues[2][$i] = parent::arrayIndexOf($stringArrayOfWindDirection, $arraysOfValues[2][$i]); // Направление ветра
			$arraysOfValues[3][$i] = (int)($arraysOfValues[3][$i]); // Влажность
		}

		return $arraysOfValues;
	}

	public static function getData() {
		$context = parent::getContext();
		$siteHtml = file_get_contents(self::$siteInfo['url'], false, $context);

		$arraysOfValues = array(
			Parser::getData($siteHtml, self::$siteInfo['temp'], 'values'), // Температура
			Parser::getData($siteHtml, self::$siteInfo['wind'], 'values'), // Ветер
			Parser::getData($siteHtml, self::$siteInfo['wind'], 'directions'), // Направление ветра
			Parser::getData($siteHtml, self::$siteInfo['humidity'], 'values') // Влажность
		);

		return self::refactorArrays($arraysOfValues);
	}

	public static function main() {
		echo 'Hello World!<br>';
		echo 'Server date is ';
		echo date('d.m.Y') . '<br>';
		echo 'Server time is ';
		echo date('H:i:s') . '<br>';
		echo 'Gismeteo temperature:<br>';

		$context = parent::getContext();
		$siteHtml = file_get_contents(self::$siteInfo['url'], false, $context);

		$arrayOfTemperatures = Parser::getData($siteHtml, self::$siteInfo['temp'], 'values'); // Температура
		$arrayOfWindsValues = Parser::getData($siteHtml, self::$siteInfo['wind'], 'values'); // Ветер
		$arrayOfWindsDirections = Parser::getData($siteHtml, self::$siteInfo['wind'], 'directions'); // Направление ветра
		$arrayOfHumiditys = Parser::getData($siteHtml, self::$siteInfo['humidity'], 'values'); // Влажность

		parent::printData($arrayOfTemperatures);
		parent::printData($arrayOfWindsValues);
		parent::printData($arrayOfWindsDirections);
		parent::printData($arrayOfHumiditys);
	}
}

GismeteoData::main();
?>