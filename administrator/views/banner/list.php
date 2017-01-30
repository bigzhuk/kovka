<?php

/**
 * @var $this yii\web\View
 * @var $data_provider \yii\data\ActiveDataProvider
 */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Управление рекламными блоками';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $data_provider,
        'columns' => [
            'id',
            'title',
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действия',
                'headerOptions' => ['width' => '80'],
                'template' => '{update} {delete}',
            ],
        ],
    ]);
    ?>
    <?= Html::a('Добавить', ['banner'], ['class'=>'btn btn-primary']);?>

</div>
