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


<h1>Примеры работ</h1>
<div class="container">
	<?php
	$folders = Gallery::get_photo_folders();
	foreach ($folders as $folder => $title) {
		echo Gallery::draw_photo_table($folder, $title);
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