<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
<style>
    .mini_gallery{
        /*border-collapse: collapse;*/
        height: 200px;
        max-width: 100% !important;
        margin-bottom: 10px;
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
$category_id = !empty($_GET['category_id']) ? (int)$_GET['category_id'] : null;
$subcategory_id = !empty($_GET['subcategory_id']) ? (int)$_GET['subcategory_id'] : null;

$search_params = [];
if (!empty($_GET['f_keyword'])) {
    $search_params['f_keyword'] = $_GET['f_keyword'];
}
if (!empty($_GET['price_from'])) {
    $search_params['price_from'] = $_GET['price_from'];
}
if (!empty($_GET['price_to'])) {
    $search_params['price_to'] = $_GET['price_to'];
}
$model = new \Catalog\Model\Catalog();
$decorator = new \Catalog\Decorator\Catalog();

?>

<div class="container">
    <?php echo $decorator->renderSearchForm($search_params); ?>
</div>
<div class="container" id="catalog">
    <script>
        $(document).ready(function() {
            $('#categories').on('change', function() {
              var selected_id = ($(this).val());
                window.location = "http://<?=$_SERVER['HTTP_HOST']?>/catalog?category_id="+selected_id;
            });

            $('.parent-container').each(function(index, el) {
                $(el).magnificPopup({
                    delegate: 'td', // child items selector, by clicking on it popup will open
                    type: 'image',
                    gallery: {
                        enabled: true,
                        tCounter: '%curr% из %total%'
                    },
                    image: {
                        titleSrc: function(item) {
                            return 'Заказать: <?= \App\Index::$phones[0]?>. <a style="color: white" href="/catalog?category_id=1&id=' + item.el.attr('id') + '"><div class="button" style="display: inline-block;">Подробнее</div></a>';
                        }
                    },

                });
            });
        });
    </script>
<?php

if ($category_id || !empty($search_params)) {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : null;
    if ($id) { // страница конкретного товара
        $good = $model->getById($id);
        echo $decorator->renderGoodPage($good, \Catalog\Model\Catalog::getKeyValCategories());
    } else { // страница каталога (таблица с товарами)
        $limit = $decorator->getItemsOnPageCount();
        $page = !empty($_GET['page']) ? (int)$_GET['page'] : null;
        $offset = $page  ? $limit*($page-1) : 0;
        $goods = $model->getAllPublished($category_id, $subcategory_id, $limit, $offset, $search_params);
        echo !empty($search_params)
            ? $decorator->renderFoundGoods($goods)
            : $decorator->renderCategory($category_id, $subcategory_id, $goods);
    }
} else {
    echo $decorator->renderCatalog(\Catalog\Model\Catalog::getOrderedCategories(), 'Категории каталога');
}

?>
</div>