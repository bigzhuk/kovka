<?php
require_once('classes/autoload.php');

$new_controller = new News\Controller\News(new \News\Model\News(), new \News\Decorator\BlockKovkaFront());
$new_rows = $new_controller->getNewsModel()->getAllPublishedNews();
$ad_text = $new_controller->getNewsDecorator()->renderReklamniyBlock($new_rows);
?>

<?php include('static/slider.php'); ?>

<div class="container">
	<p>Если вы ищете, где можно заказать навес, ворота, лестницу или другое кованное изделие
	любой сложности - вы на парвильном пути. Компания  «СУС-СТРОЙ» выполнит работу качественно и в срок .
	<a href = "price_list">Наши цены</a> доступны, а <a href = "examples">галлерея выполненных заказов</a>,
	содержит более 500 примеров, что лишний раз подтверждает наш богатый опыт в сфере изготовления кованных изделий.</p>
	<h2>Нуши услуги</h2>
	<ul>
		<li>Монтаж ворот, калиток, дверей.
		<li>Производство сварных или сборных металлических лестниц разнообразных форм, с использованием элементов художественной ковки.
		<li>Производство большого ассортимента художественных кованых изделий.
		<li>Производство и укладка тротуарной плитки, бордюров и стеновых блоков.
	</ul>

</div>