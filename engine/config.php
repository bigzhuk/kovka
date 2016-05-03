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
	$db_hostname = 'localhost';
	$db_username = 'asfaltkroshka';
	$db_password = 'axRRtEmu8nvrBKLD';
	$db_database = 'asfaltkroshka';
	//include($GLOBALS['path'].'/engine/mysql.php');
	include('mysql.php');
	# Класс для работы с БД
	// $sql = new MySQL($db_hostname, $db_username, $db_password, $db_database);

	include('mail.php');
	$mailSMTP = new SendMailSmtpClass();

?>