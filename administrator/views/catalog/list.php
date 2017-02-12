<?php

/**
 * @var $this yii\web\View
 * @var $data_provider \yii\data\ActiveDataProvider
 */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Управление каталогом';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

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
                'header' => 'Категория',
                'value' => function($model) {
                    require_once('../../classes/Catalog/Model/Catalog.php');
                    return \Catalog\Model\Catalog::$categories[$model->category_id];
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
