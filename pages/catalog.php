<h1>Каталог продукции</h1>
<div class="container">
    <script>
        $(document).ready(function() {
            $('#categories').on('change', function() {
              var selected_id = ($(this).val());
                window.location = "http://<?=$_SERVER['HTTP_HOST']?>/catalog?category_id="+selected_id;
            });
        });
    </script>

<?php
$category_id = (int)$_GET['category_id'];
if (empty($category_id)) {
?>
    <script>
         window.location = "http://<?=$_SERVER['HTTP_HOST']?>/catalog?category_id=1";
    </script>'
<?php
}

require_once('classes/autoload.php');

$model = new \Catalog\Model\Catalog();
$decorator = new \Catalog\Decorator\Catalog();
$goods = $model->getAllPublished($category_id);

?>

<style>
    .prod_box:hover {
        -moz-box-shadow: 0 0 3px 1px #D8DCDF;
        -webkit-box-shadow: 0 0 3px 1px #D8DCDF;
        box-shadow: 0 0 3px 1px #D8DCDF;
    }
    .prod_box:hover {
        -moz-box-shadow: 0 0 3px 1px #D8DCDF;
        -webkit-box-shadow: 0 0 3px 1px #D8DCDF;
        box-shadow: 0 0 3px 1px #D8DCDF;
    }
    .prod_box {
        font-family: Tahoma;
        border: 1px solid #D8DCDF;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px;
        text-align: center;
        vertical-align: top;
        display: inline-block;
        -webkit-box-flex: 1;
        -moz-box-flex: 1;
        -webkit-flex: 1 1 200px;
        -moz-flex: 1 1 200px;
        -ms-flex: 1 1 200px;
        flex: 1 1 200px;
        min-width: 200px;
        max-width: 250px;
        width: 95%;
        height: 260px;
        padding: 10px 0;
        margin: 4px;
        zoom: 1;
        cursor: pointer;
    }
    .img_box {
        margin: 10px;
    }
    .art {
        color: darkgrey;
    }
    .price {
        color: darkred;
        font-weight: bold;
        font-size: 110%;
    }
</style>

<h2><?= \Catalog\Model\Catalog::$categories[$category_id] ?></h2>
    Выберите категорию: <?= $decorator->renderChooseCategoryList(Catalog\Model\Catalog::$categories); ?>
<div align="center">
    <?= $decorator->renderCatalogTable($goods); ?>
</div>
</div>