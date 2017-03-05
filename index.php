<?php include('engine/ajax.php'); ?>
<?php
class App {
	public static $phones = array(
		'+7(499)899-78-87','+7(926)300-29-09',
	);
	public static $email = 'sus-stroy@mail.ru';
}
class Gallery {
	public static function get_photo_folders() {
		return array(
			'naves' => 'Навесы',
			'balkon' => 'Балконы',
			'besedka' => 'Беседки',
			'lestnica' => 'Лестницы',
			'mangal' => 'Мангалы',
			'mebel' => 'Мебель и интерьер',
			'mostik' => 'Мостики',
			'ogradka' => 'Оргадки',
			'reshetka' => 'Решётки',
			'urna' => 'Урны',
			'vorota' => 'Ворота',
			'zabor' => 'Заборы'
		);
	}

	public static function drawProductPhotoTable($photos) {
		return
			'<table class="mini_gallery" cellspacing="10" style="float: left">
					<tbody>
						<tr class="parent-container">'
			.self::drawProductPhotoTr($photos).'
						</tr>
					</tbody>
			</table><div style="clear: left"></div>';
	}

	private static function drawProductPhotoTr($photos) {
		$out = '';

		foreach ($photos as $photo) {
				$thumb = \Catalog\Decorator\Catalog::getThumbPathFromPhotoPath($photo);
				$out.= '<td style="height: 1px; background-image: url(\''.$thumb.'\')" href="'.$photo.'"></td>';
		}
		return $out;
	}


	public static function draw_photo_table($folder, $title = '', $count = 10) {
		$title = $title ? '<h2>'.$title.'</h2>' : '';
		$out =
			$title.'
			<table class="mini_gallery" cellspacing="10">
					<tbody>
						<tr class="parent-container">'
					.self::draw_photo_tr($folder, $count).'
						</tr>
					</tbody>
			</table>';
		return $out;
	}

	public static function draw_photo_tr($folder, $count) {
		$out = '';
		for ($i=1; $i <= $count; $i++) {
			$i = $i < 10 ? '0'.$i : $i;
			if(is_file('images/photo/'.$folder.'/'.$i.'.jpg')) {
				$out.= '<td style="background-image: url(\'images/photo/'.$folder.'/'.$i.'.jpg\')"
			href="images/photo_big/'.$folder.'/'.$i.'.jpg"></td>';
			}
		}
		return $out;
	}
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
	<script type="text/javascript" src="http://beneposto.pl/jqueryrotate/js/jQueryRotateCompressed.js"></script>

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
				<a onclick="show_recall();"><img id="phone_img" src="/images/phone.png" /></a>
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

