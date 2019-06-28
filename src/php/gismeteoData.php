<?php
	echo 'Hello World!<br/>';
	echo "Current date is ";
	echo date('d.m.Y') . '<br/>';
	echo 'Temperature:<br/>';
	
	function parseWithTags($htmlText, $startTag, $endTag) {
		$startPosition = strpos($htmlText, $startTag);
		if ($startPosition === false) {
			return 0;
		}
		$cutHtmlText = substr($htmlText, $startPosition);
		$endPosition = strpos($cutHtmlText, $endTag);
		if ($endPosition === false) {
			return 0;
		}
		return substr($cutHtmlText, 0, $endPosition); // strip_tags()
	}

	function parse($htmlText, $startTag, $endTag) {
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
			$values[] = strip_tags(substr($cutHtmlText, 0, $endPosition));
			$cutHtmlText = substr($cutHtmlText, $endPosition);
			$startPosition = strpos($cutHtmlText, $startTag);
		}
		return array($values, 0);
	}

	$siteInfo = array(
		'url' => 'https://www.gismeteo.ru/city/hourly/4079/',
		'temp_tags' => array(
			'start' => '<div class="templine w_temperature">',
			'end' => '</span></div></div>',
			'temp_values_tags' => array(
				'start' => '<span class="unit unit_temperature_c">',
				'end' => '</span>'
		),
		),

	);

	$siteURL = file_get_contents($siteInfo['url']);
	$siteTempTags = $siteInfo['temp_tags'];
	$tempDataWithTags = parseWithTags($siteURL, $siteTempTags['start'], $siteTempTags['end']);

	$siteTempValuesTags = $siteTempTags['temp_values_tags'];
	$tempValues = parse($tempDataWithTags, $siteTempValuesTags['start'], $siteTempValuesTags['end']);
	if ($tempValues[1] == 1) {
		echo 'DATA ERROR<br/>';
	}
	foreach ($tempValues[0] as $value) {
		echo $value . '<br/>';
	}

?>