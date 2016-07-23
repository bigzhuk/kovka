<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script type="text/javascript" src="http://beneposto.pl/jqueryrotate/js/jQueryRotateCompressed.js"></script>
</head>
<body>
<?php

?>
<form name="test_form" method="post" action="">
Введите число<input  name="digit" type="text" />
<input name="go" type="submit" title="Рассчиать">
</form>

<?php
if (isset($_POST['go'])) {
		$digit = $_POST['digit'];
		if (empty($digit)) {
			echo 'поле надо заполнить';
			return;
		}
		if (!is_numeric($digit)) {
			echo 'вы ввели не цифру';
			return;
		}
		$len = (strlen($digit));
		$sum = 0;
		for ($i=0; $i<$len; $i++) {
			$sum += $digit[$i];
		}

		echo 'Сумма цифр введенного числа: '.$sum;
}
?>

</body>
</html>