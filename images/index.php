<?php include('engine/mysql.php'); ?>
<?php include('engine/config.php'); ?>
<?php include('engine/engine.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Кузнецов Дмитрий</title>
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">



	<link rel="stylesheet/less" href="/style/main.less">
	<?php if ($redirect[1] == 'admin'){ ?>
	<link rel="stylesheet/less" href="/style/admin.less">
	<?php } ?>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/1.7.0/less.min.js"></script>

	<script src="/js/style.js"></script>
	
	<script type="text/javascript" src="js/fancybox/jquery.fancybox.js"></script>
	<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox.css" media="screen" />

	<script src="js/paper-full.js"></script>

</head>
<body>


	<div id="wrapper">
	<?php //include('pages/stars.php'); ?>
	<div id="azimov"><?php include('pages/azimov.php'); ?></div>
	
		<div id="main">

		<?php 

		if ($redirect[1] == ''){
			$redirect[1] = 'home';
		}?>

		<?php include('pages/header.php'); ?>
		<?php if (file_exists('pages/'.$redirect[1].'.php')){
			include('pages/'.$redirect[1].'.php');
		} else {
			include('pages/404.php');
		}?>
		<div id="push"></div>
		</div>
	</div>

	<?php include('pages/footer.php'); ?>
</body>
</html>