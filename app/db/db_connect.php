<?php
	$db_address = 'localhost';
	$db_login = 'root';
	$db_password = '';
	$db_database = 'ITU';
	$db = mysqli_connect($db_address, $db_login, $db_password, $db_database);
	// Change character set to utf8
	mysqli_set_charset($db,"utf8");
?>