<div id="header">

	<div id="recall_form" class="popup">
		<p style="color:white; text-align: left">
		Мы вам перезвоним.:) Ежедневно с 10:00 до 20:00</p>
		<span style="color: white">Имя:</span> <input id="recall_name"  name="name" type="text" ><br>
		<span style="color: white">Тел.:</span> <input id="recall_phone" name="phone" type="text" value="Телефон"><br>
		<input id="recall_btn" type="button" value="Отправить" onclick="recall();">
	</div>

	<div id="recall_success" class="popup">
		<p style="color: white">Спасибо. В ближайшее время вам перезвонят!</p>
	</div>

	<div id="map" class="popup" style="width: 800px; margin-left: -400px; top: 10%;">
		<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=RNdvmzGTnkScBv8hNZW-1oFRRXKR7agM&width=800&height=720&lang=ru_RU&sourceType=constructor&scroll=true"></script>
	</div>
	
	<table id="header_top">
		<tbody>
			<tr>
				<td id="phones">

					<?= App::$phones[0]?><br>
					<?= App::$phones[1]?><br>
					<a id="show_recall_btn" onclick="show_recall();">Обратный звонок</a>
					<!-- @TODO Указать время, когда принимаются звонки! Сделать форму - заказ обратного звонка. Как на dadget.ru. -->
					<!-- (Использовать inputmask для номера.) -->
				</td>
				<td><a href="/" id="logo"><div style="padding-top: 55px;">Студия художественной ковки</div></a></td>
				<td id="mails">
					<?= App::$email?><br>
					<a onclick="showMap();">п. Лесной, ул. Мичурина, д. 11</a>
				</td>
			</tr>
		</tbody>
	</table>

	<div id="header_bottom">

		<div id="main_menu">	

			<center>

				<div class="menu_section">
					<a class="main_menu_link<?php if (strpos($_SERVER["REDIRECT_URL"], 'about') > 0){ echo ' active';} ?>" href="about">О компании</a>
				</div>

				<!-- <div class="menu_section">
					<a class="main_menu_link<?php if (strpos($_SERVER["REDIRECT_URL"], 'service') > 0){ echo ' active';} ?>" href="service">Услуги</a>
				</div> -->

				<div class="menu_section">
					<a class="main_menu_link<?php if (strpos($_SERVER["REDIRECT_URL"], 'examples') > 0){ echo ' active';} ?>" href="examples">Наши работы</a>
					<a class="sub_menu_link" style="display: none" href="navesy">Навесы</a>
				</div>

				<div class="menu_section">
					<a class="main_menu_link<?php if (strpos($_SERVER["REDIRECT_URL"], 'price_list') > 0){ echo ' active';} ?>" href="price_list">Цены</a>
				</div>

				<div class="menu_section">
					<a class="main_menu_link<?php if (strpos($_SERVER["REDIRECT_URL"], 'delivery') > 0){ echo ' active';} ?>" href="delivery">Доставка</a>
				</div>

				<div class="menu_section">
					<a class="main_menu_link<?php if (strpos($_SERVER["REDIRECT_URL"], 'contacts') > 0){ echo ' active';} ?>" href="contacts">Контакты</a>
				</div>

			</center>
		
		</div>
		
	</div>


</div>

<script>
	$(document).ready(function() {
		$('#recall_phone').mask('8 (999) 999-9999',{placeholder:"×"});
	});

	function hidePopup(){
		$('#mask,.popup').fadeOut(500);
	}

	function showMap(){
		$('#mask,#map').fadeIn(500);
	}

	function show_recall(){
		$('#mask,#recall_form').fadeIn(500);
	}

	function recall(){
		var phone = $('#recall_phone').val();
		var name = $('#recall_name').val();

		$('#recall_btn').prop('disabled', 'disabled');
		$.ajax({
			url: 'engine/ajax.php',
			type: 'POST',
			dataType: 'json',
			data: {action: 'recall', phone: phone, name: name},
		})
		.done(function(data) {
			console.log(data);
			$('#recall_btn').prop('disabled', false);
			$('#recall_form').fadeOut(500);
			$('#recall_success').fadeIn(500);
			setInterval(function(){
				hidePopup();
			}, 3000);
		});
	}
</script>