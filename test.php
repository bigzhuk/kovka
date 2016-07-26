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
class a {
	public static function aa() {
		return 1;
	}
}
class b extends a {
	public static function aa() {
		return 5;
	}
}

$b = new b;
echo $b->aa();

?>

</body>
</html>