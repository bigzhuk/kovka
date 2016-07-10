<?php include('engine/ajax.php'); ?>
<?php
class App {
	public static $phones = array(
		'+7(499)899-78-87','+7(926)300-29-09',
	);
	public static $email = 'sus-stroy@mail.ru';

}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<script>console.groupCollapsed('Загрузка');</script>
	<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
	<meta charset="UTF-8">
	<title>«Сус Строй» — студия художественной ковки</title>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

	<script src="js/script.js"></script>

	<link rel="stylesheet/less" href="/style/style.less?q=<?php echo rand(1, 9999); ?>">
	<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.5.3/less.min.js"></script>
	<script src="js/script.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
	
	<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,400italic,700,700italic,300italic,300&subset=cyrillic-ext,latin' rel='stylesheet' type='text/css'>
</head>
<body>

	<div id="background"></div>

	<div id="wrapper">
		<div id="mask" onclick="hidePopup();"></div>
		<?php include('static/header.php'); ?>	
		<div id="content">
			<div style="
				    width: 40px;
					height: 40px;
					position: fixed!important;
					bottom: 150px;
					opacity: 0.8;
					z-index: 100!important;
					left: 10px;
					cursor: pointer">
				<a onclick="show_recall();"><img src="/images/phone.png" /></a>
			</div>
			<?php include('engine/redirect.php'); ?>
		</div>
		<div id="wrapper_push"></div>
	</div>

	<?php include('static/footer.php'); ?>	

	

</body>
</html>

<script>
	console.groupEnd();
</script>

