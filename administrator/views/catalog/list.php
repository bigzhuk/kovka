<?php

/**
 * @var $this yii\web\View
 * @var $data_provider \yii\data\ActiveDataProvider
 * @var $selected_category_id \yii\data\ActiveDataProvider
 */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
require_once('../../classes/Catalog/Model/Catalog.php');

$this->title = 'Управление каталогом';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div>
        <h4>Фильтр по категориям:</h4>
        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
        ]); ?>
        <?= Html::dropDownList('category_id', $selected_category_id, \Catalog\Model\Catalog::getKeyValCategories());?>
        <?= Html::submitButton('Отфильтровать') ?>

        <?php ActiveForm::end(); ?>
    </div><br/>

    <?= GridView::widget([
        'dataProvider' => $data_provider,
        'columns' => [
            [
                'header' => '№',
                'value' => 'id',
            ],
            [
                'header' => 'Название',
                'value' => 'name',
            ],
            [
                'header' => 'Артикул',
                'value' => 'art',
            ],
            [
                'header' => 'Категория',
                'value' => function($model) {
                    return \Catalog\Model\Catalog::getKeyValCategories()[$model->category_id];
                }
            ],
            [
                'header' => 'Подкатегория',
                'value' => function($model) {
                    require_once('../../classes/Catalog/Model/Catalog.php');
                    return \Catalog\Model\Catalog::$subcategories[$model->subcategory_id];
                }
            ],
            [
                'header' => 'Описание',
                'value' => 'description',
            ],
            [
                'header' => 'Показать товар?',
                'value' => function($model) {
                    return $model->is_active ? 'Да' : 'Нет';
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действия',
                'headerOptions' => ['width' => '80'],
                'template' => '{update} {delete}',
            ],
        ],
    ]);
    ?>
    <?= Html::a('Добавить', ['catalog/update'], ['class'=>'btn btn-primary']);?>

</div>
