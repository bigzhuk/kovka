<?php
	// $GLOBALS['path'] = '/var/www/kovka';
    # Отображение ошибок
    ini_set('display_errors',1);
    ini_set('error_reporting', E_ALL);

	# Русский
	setLocale(LC_ALL, 'ru_RU.UTF-8');

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
		$db_hostname = 'p377048.ispmgr.ihc.ru';
		$db_username = 'p377048_kovka';
		$db_password = 'c7a7bdbdps';
		$db_database = 'p377048_kovka';
	}


	//include($GLOBALS['path'].'/engine/mysql.php');
	include('mysql.php');
	# Класс для работы с БД
	// $sql = new MySQL($db_hostname, $db_username, $db_password, $db_database);

	include('mail.php');
	$mailSMTP = new SendMailSmtpClass();

?>