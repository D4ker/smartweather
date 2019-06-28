<?php
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
	return substr($cutHtmlText, 0, $endPosition);
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
?>