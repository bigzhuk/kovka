<?php

/**
 * @var $this yii\web\View
 * @var $data_provider \yii\data\ActiveDataProvider
 */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Управление рекламным блоком';
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
                'header' => 'Заголовок',
                'value' => 'title',
            ],
            [
                'header' => 'Текст объявления',
                'value' => 'banner_text',
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
    <?= Html::a('Добавить', ['banner/update'], ['class'=>'btn btn-primary']);?>

</div>
