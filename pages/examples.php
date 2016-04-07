<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

<style>
	.mini_gallery{
		/*border-collapse: collapse;*/
		height: 200px;	
		max-width: 100% !important;	
		margin-bottom: 20px;	
		margin-left: auto;
		margin-right: auto;
		/*width: 100%;	*/
		/*cellspacing: 10px;*/
	}
	.mini_gallery>tbody>tr>td{
		max-width: 200px !important;
		box-shadow: 0 0 5px rgba(0,0,0,.33);
		border-radius: 3px;
		transition: width .5s, filter .5s;
		overflow: hidden;
		/*filter: grayscale(50%);*/
		background-position: center center;
		background-repeat: no-repeat;
		width: 70px;	
		/*min-width: 50px;*/
	}
	.mini_gallery>tbody>tr>td:hover{
		width: 200px !important;	
		cursor: pointer;
		/*filter: grayscale(0%);*/
		/*min-width: 190px;*/
	}
	.full{
		/*width: 250px !important;	*/
	}
</style>

<?php 
function get_photo_folders() {
	return array(
		'balkon' => 'Балконы',
		'besedka' => 'Беседки',
		'lestnica' => 'Лестницы',
		'mangal' => 'Мангалы',
		'mebel' => 'Мебель и интерьер',
		'mostik' => 'Мостики',
		'naves' => 'Навесы',
		'ogradka' => 'Оргадки',
		'reshetka' => 'Решётки',
		'urna' => 'Урны',
		'vorota' => 'Ворота',
		'zabor' => 'Заборы'
	);
}

function draw_photo_table($folder, $title) {
	$out = '
	<h2>'.$title.'</h2>
	<table class="mini_gallery" cellspacing="10">
			<tbody>
				<tr class="parent-container">'
					.draw_photo_tr($folder).'
				</tr>
			</tbody>
	</table>';
	return $out;
}

function draw_photo_tr($folder) {
	$out = '';
	for ($i=1; $i <= 10; $i++) {
		$i = $i < 10 ? '0'.$i : $i;
		if(is_file('images/photo/'.$folder.'/'.$i.'.jpg')) {
			$out.= '<td style="background-image: url(\'images/photo/'.$folder.'/'.$i.'.jpg\')"
			href="images/photo_big/'.$folder.'/'.$i.'.jpg"></td>';
		}
	}
	return $out;
}
?>

<h1>Примеры работ</h1>
<div class="container">
	<?php
	$folders = get_photo_folders();
	foreach ($folders as $folder => $title) {
		echo draw_photo_table($folder, $title);
	}
	?>
</div>

<script>
	$(document).ready(function() {
		$('.parent-container').each(function(index, el) {
			$(el).magnificPopup({
				delegate: 'td', // child items selector, by clicking on it popup will open
				type: 'image',
				gallery: {
			      enabled: true
			    },
			});
		});
		// $('.parent-container')
	});
</script>