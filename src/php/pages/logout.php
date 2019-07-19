<?php
require_once(__DIR__ . '/../init/session.php');

unset($_SESSION['logged_user']);

header('Location: /');
?>