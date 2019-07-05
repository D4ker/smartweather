<?php
class Parser {
	public static function parseWithTags($htmlText, $startTag, $endTag) {
		$startPosition = strpos($htmlText, $startTag);
		if ($startPosition === false) {
			return 0;
		}
		$cutHtmlText = substr($htmlText, $startPosition);
		$endPosition = strpos($cutHtmlText, $endTag);
		if ($endPosition === false) {
			return 0;
		}
		return substr($cutHtmlText, 0, $endPosition);
	}

	public static function parse($htmlText, $startTag, $endTag) {
		$values = array();
		$startPosition = strpos($htmlText, $startTag);
		if ($startPosition === false) {
			return array($values, 1);
		}
		$cutHtmlText = $htmlText;
		while ($startPosition !== false) {
			$cutHtmlText = substr($cutHtmlText, $startPosition);
			$endPosition = strpos($cutHtmlText, $endTag);
			if ($endPosition === false) {
				return array($values, 1); // [arrayOfValues, isError]
			}
			$values[] = trim(strip_tags(substr($cutHtmlText, 0, $endPosition)));
			$cutHtmlText = substr($cutHtmlText, $endPosition);
			$startPosition = strpos($cutHtmlText, $startTag);
		}
		return array($values, 0);
	}

	public static function getData($siteHtml, $dataInfo, $dataTypeName) {
		$dataTags = $dataInfo['data_with_tags'];
		$dataWithTags = self::parseWithTags($siteHtml, $dataTags['start'], $dataTags['end']);
		$valuesTags = $dataInfo[$dataTypeName];
		$values = self::parse($dataWithTags, $valuesTags['start'], $valuesTags['end']);
		if ($values[1] == 1) {
			echo 'Failed to get data<br>';
			exit();
		}
		return $values[0]; // Данные
	}
}
?>