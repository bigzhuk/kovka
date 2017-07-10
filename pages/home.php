<?php
require_once('classes/autoload.php');

$new_controller = new News\Controller\News(new \News\Model\News(), new \News\Decorator\BlockKovkaFront());
$new_rows = $new_controller->getNewsModel()->getAllPublishedNews();
$banner = $new_controller->getNewsDecorator()->renderReklamniyBlock($new_rows);
?>

<?php include('static/slider.php'); ?>

<div class="container" id="catalog">
<?php
	$decorator = new \Catalog\Decorator\Catalog();
	echo $decorator->renderCatalog(\Catalog\Model\Catalog::getOrderedCategories(), 'Каталог продукции');
?>
</div>

<div class="container">
	<h2>Два слова о нас</h2>
	<p>Если вы ищете, где можно заказать навес, ворота, лестницу или другое кованное изделие
	любой сложности - вы на правильном пути. Компания  «СУС-СТРОЙ» выполнит работу качественно и в срок .
	<a href = "price_list">Наши цены</a> доступны, а <a href = "examples">галлерея выполненных заказов</a>,
	содержит более 500 примеров, что лишний раз подтверждает наш богатый опыт работы.
	Подробнее о нас читайте в разделе <a href = about.php>о комании.</a></p>
	<h2>Наши услуги</h2>
	<ul>
		<li>Изготовление навесов из поликарбоната.
		<li>Монтаж ворот, калиток, дверей.
		<li>Производство сварных или сборных металлических лестниц разнообразных форм, с использованием элементов художественной ковки.
		<li>Производство большого ассортимента художественных кованых изделий.
		<li>Производство и укладка тротуарной плитки, бордюров и стеновых блоков.
	</ul>

</div>