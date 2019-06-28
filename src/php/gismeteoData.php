<?php
require_once("src/php/parser.php");

echo 'Hello World!<br>';
echo "Current date is ";
echo date('d.m.Y') . '<br>';
echo 'Gismeteo temperature:<br>';

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

$siteHtml = file_get_contents($siteInfo['url']);
$siteTempTags = $siteInfo['temp_tags'];
$tempDataWithTags = parseWithTags($siteHtml, $siteTempTags['start'], $siteTempTags['end']);

$siteTempValuesTags = $siteTempTags['temp_values_tags'];
$tempValues = parse($tempDataWithTags, $siteTempValuesTags['start'], $siteTempValuesTags['end']);
if ($tempValues[1] == 1) {
	echo 'DATA ERROR<br>';
}
foreach ($tempValues[0] as $value) {
	echo $value . '<br>';
}

?>