<?php
define('START_WORK', 2010);
?>

<h1>Информация о навесах:</h1>

<div class="container">
	<img src="images/navesy_big/navesi_iz_polikorbonata.jpg" style="width: 100%;"><br/><br/>
	<h2>Цены на навесы из поликарбоната</h2>
	<p>Сделав заказ сейчас, вы получите <span style="color: #C42034; font-weight: bold">бесплатно</span>: </p>
        <ul class="page_list">
            <li>Выезд замерщика;
            <li>Доставку по Москве и области;
            <li>Гарантию до 25 лет;
        </ul>
    <p>
        <a href="/price_list">Цены на навесы</a> в нашей компании начинаются <span style="color: #C42034; font-weight: bold">от 1800</span> р за м².
		До конца лета действует <span style="color: #C42034; font-weight: bold">Акция -</span> cкидка 10% на изготовление
		любого навеса из поликарбоната.
		Позвоните сейчас и убедитесь: наши цены ниже, чем у конкурентов. Держать низкие цены нам позволяет
		наличие собственного производства и большой объем заказов.
    </p>
    <div align="center"><div class="button" onclick="show_recall();" >Заказать</div></div>
    <h2>Цветовая гамма</h2>
    <p> <strong>Цвета покрытия<strong>:</p>
   <img src="images/navesy_big/colors.jpg" style="width: 100%;"><br/><br/>
    <p><strong>Цвета металлоконструкций</strong>:</p>
    <?php $ral = glob('images/navesy_big/RAL*');?>
    <table style="width: 100%; text-align: center;">
        <tbody>
        <tr>
            <?php echo  \Catalog\Decorator\Catalog::renderRalTds($ral, 0, 5); ?>
        </tr>
        <tr>
            <?php echo  \Catalog\Decorator\Catalog::renderRalTds($ral, 6, 11); ?>
        </tr>
        <tr>
            <?php echo  \Catalog\Decorator\Catalog::renderRalTds($ral, 12, 17); ?>
        </tr>
        </tbody>
    </table><br/>
    <div align="center"><div class="button" onclick="show_recall();" >Заказать</div></div>

    <h2>Материалы</h2>
    <p>Типы кровельного покрытия:</p>
    <ul class="page_list">
        <li>Cотовый поликарбонат;
        <li>Монолитный поликарбонат;
        <li>Металлочерепица;
        <li>Профнастил;
        <li>Мягкая кровля;
    </ul>
    <p>Поликарбонат – современный материал, вобравший в себя преимущества стекла
        (прозрачность, визуальная легкость, высокая светопроницаемость), но не обладающий его недостатками,
        главные из которых - хрупкость и большой вес.  Изготовление навесов из этого материала позволило получить практичную
        конструкцию, которая смотрится так же изящно, как стеклянная, но при этом отличается ударопрочностью и безопасностью.</p>
    <div align="center"><div class="button" onclick="show_recall();" >Заказать</div></div>
	<h2>Виды навесов</h2>
    <p>Наша компания изготавливает навесы, имеющие различные <strong>сферы применения</strong>:</p>
	<ul class="page_list">
		<li>Навесы для автомобиля;
		<li>Навесы для бассейнов;
		<li>Навесы над крыльцом или террасой;
		<li>Навесы для балконов;
	</ul>
	<p>Исходя из конструкционных особенностей выделяют следующие <strong>категории навесов</strong>:</p>
	<div>
		<div style="float: left;">
			<img src="images/navesy_small/naves_odnoskatniy.jpg" style="width: 250px; height: 125px;  margin-left: 15px; border-radius: 3px;">
			<div align="center">Односкатные. <span style="color: #C42034">От 1800 р за м²</span></div>
		</div>
		<div style="float: left;">
			<img src="images/navesy_small/naves_dvuskatniy.jpg" style="width: 250px; height: 125px;  margin-left: 15px; border-radius: 3px;">
			<div align="center">Двускатные. <span style="color: #C42034">От 2000 р за м²</span></div>
		</div>
		<div style="float: left;">
			<img src="images/navesy_small/naves_arochniy.jpg" style="width: 250px; height: 125px;  margin-left: 15px; border-radius: 3px;">
			<div align="center">Арочные. <span style="color: #C42034">От 2150 р за м²</span></div>
		</div>
		<div style="float: left;">
			<img src="images/navesy_small/naves_kovanniy.jpg" style="width: 250px; height: 125px;  margin-left: 15px; border-radius: 3px;">
			<div align="center">Кованые. <span style="color: #C42034">От 4000 р за м²</span></div>
		</div>
	</div>
	<div style="clear: both"></div><br/>
    <div align="center"><div class="button" onclick="show_recall();" >Заказать</div></div>
	<h2>Навесы для автомобиля</h2>
	<p>
		<img src="images/navesy_big/naves_iz_polikarbonata_dlya_avto.jpg" class="left" style="width: 200px; height: 150px; margin-bottom: 5px;">
		Защитные сооружения из металлического каркаса, покрытого сотовым поликарбонатом – практичное и выгодное решение
		для владельцев машин и автостоянок. Такая конструкция отличается долговечностью и хорошим внешним
		видом, не требует серьезных вложений.
		Прочные <strong>автомобильные навесы</strong> из поликарбоната удачно вписываются в современный ландшафтный дизайн
		и выдерживают существенные нагрузки.
		Если у вас есть загородный дом, а автомобиль парковать негде - навес для автомобиля легко решит эту проблему.
		Автонавес надежно защитит вашу технику от воздействия снега, дождя и солнца.
		<div align="center"><div class="button" onclick="show_recall();" >Заказать</div></div>
	</p>

	<h2>Навесы для бассейнов</h2>
	<p>
		<img src="images/navesy_big/naves_iz_polikarbonata_dlya_bassejna.jpg" class="left" style="width: 200px; height: 150px; margin-bottom: 5px;">
		<strong>Павильон для бассейнов</strong> является достаточно комфортабельным инженерным сооружением, которое помимо своей функциональности
		дополнительно служит в качестве декорационного дополнения к жилой территории.
		Не смотря на то, что технология изготовления навесов для бассейнов из поликарбоната достаточно нова,
		она  быстро получила распростарнение. Наша компания возводит <strong>навесы для бассейна</strong>
		любой сложности по доступным ценам.
		<br/>
		<div align="center"><div class="button" onclick="show_recall();" >Заказать</div></div>
	</p>

	<h2>Навесы над крыльцом</h2>
	<p>
		<img src="images/navesy_big/naves_iz_polikarbonata_nad_kriltsom.jpg" class="left" style="width: 200px; height: 150px; margin-bottom: 5px;">
		Театр начинается с вешалки, квартира с прихожей, а первое впечатление о доме создает козырек над крыльцом.
		Классический элемент дизайна не только защищает вход в жилище. Он помогает создать его оригинальное оформление.
		Мы создаем изысканные <strong>навесы над крыльцом</strong>, которые выгодно выделят ваш дом, придав ему уюта и шарма.
		Но если большие траты не входят в ваши планы, мы всегда подберем
		для вас более доступную модель. Наш ассортимент достаточно широк, чтобы удовлетворить запрос на любой вкус
		и кошелек.
		<div align="center"><div class="button" onclick="show_recall();" >Заказать</div></div>
	</p>

	<h2>Навесы над балконом</h2>
	<p>
		<img src="images/navesy_big/naves_iz_polikarbonata_nad_balkonom.jpeg" class="left" style="width: 200px; height: 150px; margin-bottom: 5px;">
		Отдых на балконе является распространенным способом провести свободное время во многих странах,
		особенно, если с балкона открывается отличный вид. Красиво оформленный балкон, на котором стоит легкий
		стеклянный стол и плетеное кресло станет вашим любимым местом, где вы сможете часами наслаждаться музыкой,
		хорошим табаком в трубке или чашкой чая.
		Для того, чтобы солнце не мешало обзору и не создавало излишнюю духоту, а дождь не испортил трапезу,
		над балконом нужно установить навес. Совсем недавно для этих целей использовались многие материалы,
		каждый из которых имел свои достоинства и недостатки.
		Они обязательно учитывались при проектировании и значительно ограничивали возможности дизайнеров.
		<strong>Навесы над балконом</strong> на данный момент чаще всего укрывают поликарбонатом, который открыл новую страницу в изготовлении и
		заслужил всеобщее признание.
		Именно этот материал выбирает большинство наших клиентов, заказывающих различные навесы и козырьки.
		<div align="center"><div class="button" onclick="show_recall();" >Заказать</div></div>
	</p>


</div>