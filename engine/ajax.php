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
		if (empty($phone)) {
			die;
		}
		$mailto = 'sus-stroy@mail.ru';
		$subject = 'Обратный звонок';
		$message = 'Обратный звонок от пользователя sus-stroy.ru<br>
		Имя: '.$name.'<br>
		Тел.: '.$phone;
		if (sendMail($mailto, $subject, $message)){
			$result['success'] = 'sendMail';
		} else if (mail($mailto, $subject, $message)){
			$result['success'] = 'mail';
		} else {
			$result['error'] = 'recall';
		}
		return $result;
	}

?>