<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?=$_SERVER['HTTP_HOST']; ?>Администрирование сайт sus-stroy.ru</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../style/ui.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
	<h2>Панель управления сайтом sus-stroy.ru</h2>
	<?php require_once('../static/admin_menu.php');?>
</div>
<script>
	$(document).ready(function() {
		$('.datepicker').datepicker();
	});
</script>


<?php
require_once('../classes/autoload.php');


$auth_controller = new \Auth\Controller\Auth(new \Auth\Model\Auth(), new \Auth\Decorator\Auth());
if(isset($_GET['action']) && $_GET['action'] == 'exit') {
	$auth_controller->actionExit();
}
if (empty($_SESSION['login']) or empty($_SESSION['id'])) { // Проверяем, пусты ли переменные логина и id пользователя
	$msg_result = isset($_GET['msg_result']) ? $_GET['msg_result'] : '';
	$auth_controller->actionAuth($msg_result);
}
else {
	$msg_result = isset($_GET['msg_result']) ? $_GET['msg_result'] : '';
	$auth_controller->actionAuthComplete($msg_result);
}

?>

</body>
</html>

