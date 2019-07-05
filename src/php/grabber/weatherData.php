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
			array(), array(), array(), array(), array()
		);
		foreach ($values as $value) {
			$arrays[$i][$j] = trim($value);
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
		$stringArrayOfWindDirection = array(
			'С', 'ССВ', 'СВ', 'ВСВ', 'В', 'ВЮВ', 'ЮВ', 'ЮЮВ', 'Ю', 'ЮЮЗ', 'ЮЗ', 'ЗЮЗ', 'З', 'ЗСЗ', 'СЗ', 'ССЗ'
		);

		// Температура, ветер, направление ветра, влажность
		$refactorArrays = array(
			array(), array(), array(), array()
		);

		for ($i = 0; $i < count($arraysOfValues[0]); $i++) {
			$refactorArrays[0][] = (int)($arraysOfValues[0][$i]); // Температура

			$windDirectionValue = explode(' ', $arraysOfValues[4][$i]);
			$refactorArrays[1][] = (int)((int)($windDirectionValue[1]) / 3.6 + 0.5); // Ветер

			$refactorArrays[2][] = parent::arrayIndexOf($stringArrayOfWindDirection, $windDirectionValue[0]); // Направление ветра

			$refactorArrays[3][] = (int)($arraysOfValues[3][$i]); // Влажность
		}

		return $refactorArrays;
	}

	public static function getData() {
		$context = parent::getContext();
		$siteHtml = file_get_contents(self::$siteInfo['url'], false, $context);

		$arraysOfValues = self::parseValuesToArrays(Parser::getData($siteHtml, self::$siteInfo['data'], 'values'));

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