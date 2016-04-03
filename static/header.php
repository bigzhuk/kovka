<div id="header">

	<div id="recall_form" class="popup">
		<input type="text" value="Имя"><br>
		<input type="text" value="Телефон"><br>
		<input id="recall_btn" type="button" value="Отправить" onclick="recall();">
	</div>

	<div id="recall_success" class="popup">
		В ближейшее время вам перезвонят!
	</div>

	<div id="map" class="popup" style="width: 800px; margin-left: -400px; top: 10%;">
		<script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=Ng86sVakWqm2peB6kiAyGdSzUe0-NVUA&width=800&height=720&lang=ru_RU&sourceType=constructor"></script>
	</div>
	
	<table id="header_top">
		<tbody>
			<tr>
				<td id="phones">

					+7 (495) 409-48-78<br>
					+7 (925) 898-43-57<br>
					<a id="show_recall_btn" onclick="show_recall();">Обратный звонок</a>
					<!-- @TODO Указать время, когда принимаются звонки! Сделать форму - заказ обратного звонка. Как на dadget.ru. -->
					<!-- (Использовать inputmask для номера.) -->
				</td>
				<td><a href="/" id="logo"></a></td>
				<td id="mails">
					info@asfaltkroshka.com<br>
					<a onclick="showMap();">г.Пушкино, ул Заводская, 9</a>
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
					<a class="main_menu_link<?php if (strpos($_SERVER["REDIRECT_URL"], 'examples') > 0){ echo ' active';} ?>" href="examples">Примеры работ</a>
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
		var phone = 'phone';
		var name = 'name';

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