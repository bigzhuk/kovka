<h1>Каталог продукции</h1>
<div class="container">
<?php
require_once('classes/autoload.php');
$model = new \Catalog\Model\Catalog();
$goods = $model->getAllPublished();
foreach ($goods as $good) {
    echo $good['name'];
}
?>

   
</div>