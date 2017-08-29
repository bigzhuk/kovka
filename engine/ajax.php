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

        switch ($_POST['call_time']) {
            case 1:
                $call_time = 'Первая половина дня 9:00-15:00';
                break;
            case 2:
                $call_time = 'Вторая половина дня 15:00-21:00';
                break;
            case 3:
                $call_time = 'В ночное время 21:00-2:00';
                break;
            default:
                $call_time = '';
        }
        $msg = strip_tags($_POST['call_msg']);

		if (empty($phone)) {
            $result['error'] = 'recall';
			return $result;
		}
		$mailto = 'sus-stroy333@yandex.ru, bigzhuk@ya.ru';
		$subject = 'Обратный звонок';
		$message = 'Обратный звонок от пользователя sus-stroy.ru<br/>
		Имя: '.$name.'<br/>
		Тел.: '.$phone.'<br/>';
		if ($call_time) {
            $message .= 'Время звонка.: '.$call_time.'<br/>';
		}
		if ($msg) {
            $message .= 'Сообщение от клиента.: '.$msg.'<br/>';
        }

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