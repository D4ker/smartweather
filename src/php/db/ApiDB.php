<?php
class ApiDB {
	public static function connectTo($dbName) {
		$connection = mysqli_connect('127.0.0.1', 'root', '', $dbName);
		if ($connection == false) {
			echo 'Could not connect to database!<br>';
			echo mysqli_connect_error();
			exit();
		}
		return $connection;
	}

	public static function closeConnection($connection) {
		mysqli_close($connection);
	}

	public static function deleteOldData($connection, $tableName, $cityID) {
		mysqli_query($connection, "DELETE FROM `" . $tableName . "` WHERE `city_id` = " . $cityID);
	}

	public static function addRecordInTable($connection, $tableName, $cityID, $time, $temperature, $windValue, $windDirection, $humidity) {
		$result = mysqli_query($connection, "INSERT INTO `" . $tableName . "` (`city_id`, `time`, `temperature`, `wind_value`, `wind_direction`, `humidity`) VALUES (" . $cityID . ", " . $time . ", " . $temperature . ", " . $windValue . ", " . $windDirection . ", " . $humidity . ")");
		if ($result == false) {
			echo 'Failed to add record to the table!<br>';
			exit();
		}
	}

	public static function getCityInfo($connection, $cityName) {
		$result = mysqli_query($connection, "SELECT * FROM `cities` WHERE `name` = '" . $cityName . "'");
		$cityInfo = mysqli_fetch_assoc($result);
		if ($cityInfo == false) {
			echo 'Failed to select data from the table!<br>';
			exit();
		}
		return $cityInfo;
	}

	public static function updateDataInTable($connection, $tableName, $cityID, $time, $temperature, $windValue, $windDirection, $humidity) {
		self::deleteOldData($connection, $tableName, $cityID);
		for ($i = 0; $i < count($time); $i++) {
			// $cityID, $time, $temperature, $windValue, $windDirection, $humidity
			self::addRecordInTable($connection, $tableName, $cityID, $time[$i], $temperature[$i], $windValue[$i], $windDirection[$i], $humidity[$i]);
		}
	}

	public static function getDataFromTable($connection, $tableName, $cityID) {
		$result = mysqli_query($connection, "SELECT * FROM `" . $tableName . "` WHERE `city_id` = " . $cityID);
		$data = array();
		while (($record = mysqli_fetch_assoc($result)) == true) {
			$data[] = $record;
		}
		return $data;
	}

	public static function cutDataToAnotherTable($connection, $cutTableName, $insertTableName, $cityID) {
		$data = self::getDataFromTable($connection, $cutTableName, $cityID);
		self::deleteOldData($connection, $cutTableName, $cityID);
		for ($i = 0; $i < count($data); $i++) {
			self::addRecordInTable($connection, $insertTableName, $cityID, $data[$i][1], $data[$i][2], $data[$i][3], $data[$i][4], $data[$i][5]);
		}
	}
}
?>