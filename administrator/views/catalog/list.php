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
                    return  \app\models\Catalog::$categories[$model->category_id];
                }
            ],
            [
                'header' => 'Описание',
                'value' => 'description',
            ],
            [
                'header' => 'Показать товар?',
                'value' => 'is_active',
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
