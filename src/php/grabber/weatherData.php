<?php
require_once('SiteData.php');
require_once('Parser.php');

class WeatherData extends SiteData {
	private static $siteInfo = array(
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

	private function parseValuesToArrays($values) {
		$i = 0;
		$j = 0;
		// Температура, ощущается, осадки, влажность, ветер
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
			$arraysOfValues[2][$i] = parent::arrayIndexOf($stringArrayOfWindDirection, $arraysOfValues[2][$i]); // Направление ветра; indexOf from gismeteoData
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
		echo '<br>Weather temperature:<br>';

		$context = parent::getContext();
		$siteHtml = file_get_contents(self::$siteInfo['url'], false, $context);

		$arraysOfValues = self::parseValuesToArrays(Parser::getData($siteHtml, self::$siteInfo['data'], 'values'));

		$arrayOfTemperatures = $arraysOfValues[0]; // Температура
		$arrayOfTempFeels = $arraysOfValues[1]; // Ощущается
		$arrayOfPrecips = $arraysOfValues[2]; // Осадки
		$arrayOfHumiditys = $arraysOfValues[3]; // Влажность
		$arrayOfWinds = $arraysOfValues[4]; // Ветер

		$arrayOfTimes = Parser::getData($siteHtml, self::$siteInfo['data'], 'time'); // Время

		parent::printData($arrayOfTimes);
		parent::printData($arrayOfTemperatures);
		parent::printData($arrayOfTempFeels);
		parent::printData($arrayOfPrecips);
		parent::printData($arrayOfHumiditys);
		parent::printData($arrayOfWinds);
	}
}

WeatherData::main();
?>