<?php 
	# Подключаем конфигурацию
	include('config.php');

	# Перенаправление на пользовательскую функцию
	if (isset($_POST['action']) && $_POST['action']!=='') {
		$action = $_POST['action'];
		$result = $action();
		echo(json_encode($result));
	}

	function recall() {
		$phone = $_POST['phone'];
		$name = $_POST['name'];
        $call_time = $_POST['call_time'];
		if (empty($phone)) {
            $result['error'] = 'recall';
			return $result;
		}
		$mailto = 'sus-stroy@mail.ru';
        //$mailto = 'bigzhuk@ya.ru';
		$subject = 'Обратный звонок';
		$message = 'Обратный звонок от пользователя sus-stroy.ru<br/>
		Имя: '.$name.'<br/>
		Тел.: '.$phone.'<br/>
		Время звонка.: '.$call_time.'<br/>';

		$headers = '"From: robot@sus-stroy.ru\r\n" 
             ."Content-type: text/html; charset=utf-8\r\n"
             ."X-Mailer: PHP mail script"';

		if (sendMail($mailto, $subject, $message)){
			$result['success'] = 'sendMail';
		} else if (mail($mailto, $subject, $message, $headers)){
			$result['success'] = 'mail';
		} else {
			$result['error'] = 'recall';
		}
		return $result;
	}

?>