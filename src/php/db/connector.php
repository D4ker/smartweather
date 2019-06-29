<?php
function connectToDB($dbName) {
	$connection = mysql_connect('localhost', 'root', '', $dbName);
	if ($connection == false) {

	}
}
?>