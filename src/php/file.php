<?php
	echo 'Hello World!<br/>';
	echo "Current date is ";
	echo date('d.m.Y<br/>');
	
	function parse($htmlText, $startTag, $endTag) {
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

	$weatherSites = array(
		'gismeteo' => array(
			'url' => 'https://www.gismeteo.ru/city/hourly/4079/',
			'tags' => array(
				'start' => '<div class="templine w_temperature">',
				'end' => '</span></div></div>'
			)
		),
		'weather' => array(
			'url' => '',
			'tags' => array(
				'start' => '',
				'end' => ''
			)
		),
	);

	$siteInfo = $weatherSites['gismeteo'];
	$siteURL = file_get_contents($siteInfo['url']);
	$siteTags = $siteInfo['tags'];
	echo parse($siteURL, $siteTags['start'], $siteTags['end']);

?>