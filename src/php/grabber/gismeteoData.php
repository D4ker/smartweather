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
		$stringArrayOfWindDirection = array(
			'С', 'ССВ', 'СВ', 'ВСВ', 'В', 'ВЮВ', 'ЮВ', 'ЮЮВ', 'Ю', 'ЮЮЗ', 'ЮЗ', 'ЗЮЗ', 'З', 'ЗСЗ', 'СЗ', 'ССЗ'
		);

		// Температура, ветер, направление ветра, влажность
		$refactorArrays = array(
			array(), array(), array(), array()
		);

		for ($i = 0; $i < count($arraysOfValues[0]); $i++) {
			$refactorArrays[0][] = (int)($arraysOfValues[0][$i]); // Температура

			$refactorArrays[1][] = (int)($arraysOfValues[1][$i]); // Ветер

			$refactorArrays[2][] = parent::arrayIndexOf($stringArrayOfWindDirection, $arraysOfValues[2][$i]); // Направление ветра

			$refactorArrays[3][] = (int)($arraysOfValues[3][$i]); // Влажность
		}

		return $refactorArrays;
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