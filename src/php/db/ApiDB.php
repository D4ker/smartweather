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

	public static function getDataTableByFieldValue($connection, $tableName, $field, $value) {
		$result = mysqli_query($connection, "SELECT * FROM `" . $tableName . "` WHERE `". $field . "` = " . $value);
		$data = array();
		while (($record = mysqli_fetch_assoc($result)) == true) {
			$data[] = $record;
		}
		return $data;
	}

	public static function cutDataToAnotherTable($connection, $cutTableName, $insertTableName, $cityID) {
		$data = self::getDataTableByFieldValue($connection, $cutTableName, 'city_id', $cityID);
		self::deleteOldData($connection, $cutTableName, $cityID);
		for ($i = 0; $i < count($data); $i++) {
			self::addRecordInTable($connection, $insertTableName, $cityID, $data[$i]['time'], $data[$i]['temperature'], $data[$i]['wind_value'], $data[$i]['wind_direction'], $data[$i]['humidity']);
		}
	}

	public static function stringRecordInTable($connection, $tableName, $fieldName, $stringValue) {
		$result = mysqli_query($connection, "SELECT 1 FROM `" . $tableName . "` WHERE `" . $fieldName . "` = '" . $stringValue . "' LIMIT 1");
		if (mysqli_fetch_assoc($result)) {
			return true;
		}
		return false;
	}

	public static function addAccountInTable($connection, $login, $password) {
		if (self::stringRecordInTable($connection, 'accounts', 'login', $login)) {
			return false;
		}
		mysqli_query($connection, "INSERT INTO `accounts` (`login`, `password`) VALUES ('" . $login . "', '" . password_hash($password, PASSWORD_DEFAULT) . "')");
		return true;
	}

	public static function createAccount($login, $password) {
		$connection = self::connectTo('training_db');
		$result = self::addAccountInTable($connection, $login, $password);
		self::closeConnection($connection);
		return $result;
	}

	public static function authorization($login, $password) {
		$connection = self::connectTo('training_db');
		$result = mysqli_query($connection, "SELECT * FROM `accounts` WHERE `login` = '" . $login . "'");
		self::closeConnection($connection);
		$data = mysqli_fetch_assoc($result);
		if (password_verify($password, $data['password']) == false) {
			return false;
		}
		unset($data['password']);
		return $data;
	}

	public static function getFieldContents($connection, $tableName, $field) {
		$result = mysqli_query($connection, "SELECT " . $field . " FROM `" . $tableName . "`");
		$data = array();
		while (($record = mysqli_fetch_assoc($result)) == true) {
			$data[] = $record;
		}
		return $data;
	}

	public static function getTableData($connection, $tableName) {
		$result = mysqli_query($connection, "SELECT * FROM `" . $tableName . "`");
		$data = array();
		while (($record = mysqli_fetch_assoc($result)) == true) {
			$data[] = $record;
		}
		return $data;
	}

	public static function addRecordInTableUserTraining($connection, $userID, $cityID, $time, $temperature, $windValue, $windDirection, $humidity, $clothesID) {
		$result = mysqli_query($connection, "INSERT INTO `user_data` (`user_id`, `city_id`, `time`, `temperature`, `wind_value`, `wind_direction`, `humidity`, `clothes_id`) VALUES (" . $userID . ", " . $cityID . ", " . $time . ", " . $temperature . ", " . $windValue . ", " . $windDirection . ", " . $humidity . ", " . $clothesID . ")");
		if ($result == false) {
			echo '<div style="color: green;">Данные успешно добавлены в таблицу "Одежда"</div><hr>';
		}
	}

	public static function addRecordInTableUserClothes($connection, $userID, $clothesName, $categoryID) {
		$result = mysqli_query($connection, "INSERT INTO `user_clothes` (`user_id`, `clothes_name`, `category_id`) VALUES (" . $userID . ", '" . $clothesName . "', " . $categoryID . ")");
		if ($result == false) {
			echo '<div style="color: green;">Данные успешно добавлены в таблицу "Одежда"</div><hr>';
		}
	}
}
?>