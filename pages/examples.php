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

	$folder ['title'] = 'Балконы';
	$folder ['folder'] = 'balkon';
	$folder ['price'] = '15 000';
	$folders[] = $folder;

	$folder ['title'] = 'Беседки';
	$folder ['folder'] = 'besedka';
	$folder ['price'] = '15 000';
	$folders[] = $folder;

	$folder ['title'] = 'Лестницы';
	$folder ['folder'] = 'lestnica';
	$folder ['price'] = '15 000';
	$folders[] = $folder;

	$folder ['title'] = 'Мангалы';
	$folder ['folder'] = 'mangal';
	$folder ['price'] = '15 000';
	$folders[] = $folder;

	$folder ['title'] = 'Мебель и интерьер';
	$folder ['folder'] = 'mebel';
	$folder ['price'] = '15 000';
	$folders[] = $folder;

	$folder ['title'] = 'Мостики';
	$folder ['folder'] = 'mostik';
	$folder ['price'] = '15 000';
	$folders[] = $folder;

	$folder ['title'] = 'Навесы';
	$folder ['folder'] = 'naves';
	$folder ['price'] = '15 000';
	$folders[] = $folder;

	$folder ['title'] = 'Оргадки';
	$folder ['folder'] = 'ogradka';
	$folder ['price'] = '15 000';
	$folders[] = $folder;

	$folder ['title'] = 'Решётки';
	$folder ['folder'] = 'reshetka';
	$folder ['price'] = '15 000';
	$folders[] = $folder;

	$folder ['title'] = 'Урны';
	$folder ['folder'] = 'urna';
	$folder ['price'] = '15 000';
	$folders[] = $folder;

	$folder ['title'] = 'Ворота';
	$folder ['folder'] = 'vorota';
	$folder ['price'] = '15 000';
	$folders[] = $folder;

	$folder ['title'] = 'Заборы';
	$folder ['folder'] = 'zabor';
	$folder ['price'] = '15 000';
	$folders[] = $folder;

?>

<h1>Примеры работ</h1>
<div class="container">


	<?php foreach ($folders as $key => $folder) { ?>

		<h2><?php echo $folder['title']; ?></h2>

		<table class="mini_gallery" cellspacing="10">
			<tbody>
			<tr class="parent-container">
				<?php for ($i=1; $i <= 10; $i++) { ?>
				<?php if ($i<10){$i='0'.$i;} ?>
					<?php if(is_file('images/photo/'.$folder['folder'].'/'.$i.'.jpg')){ ?>
						<td style="background-image: url('images/photo/<?php echo $folder['folder']; ?>/<?php echo $i; ?>.jpg');" href="images/photo_big/<?php echo $folder['folder']; ?>/<?php echo $i; ?>.jpg"></td>
					<? } ?>
				<? } ?>
			</tr>
			</tbody>
		</table>

		<div style="text-align: center; margin-top: -25px; margin-bottom: 10px;" class="digit">от <?php echo $folder['price']; ?> руб</div>

	<?php } ?>

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