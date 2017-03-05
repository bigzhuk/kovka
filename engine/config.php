<?php

	// $GLOBALS['path'] = '/var/www/kovka';

	# Русский
	setLocale(LC_ALL, 'ru_RU.UTF-8');

	# Отображение ошибок
	error_reporting(E_ALL);
	ini_set('error_reporting', E_ALL);

	# Параметры сессии
	// session_id();
	// if(!isset($_SESSION)){
	// 	session_start();
	// }
	
	# Параметры базы данных


	if ($_SERVER['HTTP_HOST'] === 'kovka.dev') {
		$db_hostname = 'localhost';
		$db_username = 'root';
		$db_password = '';
		$db_database = 'kovka';
	} else {
		$db_hostname = 'mysql94.1gb.ru';
		$db_username = 'gb_kovka';
		$db_password = 'c7a7bdbdps';
		$db_database = 'gb_kovka';
	}


	//include($GLOBALS['path'].'/engine/mysql.php');
	include('mysql.php');
	# Класс для работы с БД
	// $sql = new MySQL($db_hostname, $db_username, $db_password, $db_database);

	include('mail.php');
	$mailSMTP = new SendMailSmtpClass();

?>