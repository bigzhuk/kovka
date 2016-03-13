<?php
	header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?=$_SERVER['HTTP_HOST']; ?> Администрирование</title>
	<link rel="stylesheet" href="../style/ui.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
</head>
<body>
	
</body>
</html>

<script>
	$(document).ready(function() {
		$(".datepicker").datepicker({
			regional: 'ru',
			monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
             'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
            dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
            firstDay: 1,
            showOtherMonths:true,
            nextText: '',
            prevText: '',
            dateFormat: 'd.m.yy',
		});
	});
</script>

<?php
require_once('../classes/autoload.php');

$new_controller = new News\Controller\News(new \News\Model\News(), new \News\Decorator\News());
$new_controller->run();