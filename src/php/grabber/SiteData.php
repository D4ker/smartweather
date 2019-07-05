<?php
abstract class SiteData {
	protected function getContext() {
		return stream_context_create(
			array(
				'http' => array(
					'header' => 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (	KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36'
				)
			)
		);
	}

	public static function printData($arrayOfData) {
		foreach ($arrayOfData as $value) {
			echo $value . ' ';
		}
		echo '<br>';
	}

	protected function arrayIndexOf($array, $element) {
		$i = 0;
		foreach ($array as $value) {
			if ($value == $element) {
				return $i;
			}
			$i++;
		}
		return -1;
	}

	abstract public static function getData();
}
?>