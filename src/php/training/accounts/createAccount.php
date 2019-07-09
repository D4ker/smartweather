<?php
// Возможно удаление данного скрипта в дальнейшем
require_once(getcwd() . '/src/php/db/ApiDB.php');

$connection = ApiDB::connectTo('training_db');

// Следующие две перменные будут брать данные из формы для ввода
$login = 'user';
$password = 'user';

ApiDB::createAccount($connection, $login, $password);

ApiDB::closeConnection($connection);
?>