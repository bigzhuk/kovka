<?php

/**
 * @var $this yii\web\View
 * @var $model app\models\BannerForm
 *  @var $ar_model app\models\Banner
 */

use nex\datepicker\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Редактирование рекламного блока';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-banner">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(); ?>

    <?php
        $form_fields = '';
        $form_fields .= $form->field($model, 'title')->textInput(['value' => $ar_model->title]);
        $form_fields .= $form->field($model, 'banner_text')->textarea(['value' => $ar_model->banner_text]);

        $form_fields .= $form->field($model, 'date_publish_start')
            ->widget(DatePicker::className(), [
                'options' => [
                    'value' =>  !empty($ar_model->date_publish_end) ? date('d.m.Y', $ar_model->date_publish_start) : null
                ],
                'language' => 'ru',
                'clientOptions' => [
                    'format' => 'L',
                ],
        ]);
        $form_fields .= $form->field($model, 'date_publish_end')
            ->widget(DatePicker::className(), [
                'options' => [
                    'value' =>  !empty($ar_model->date_publish_end) ? date('d.m.Y', $ar_model->date_publish_end) : null
                ],
                'language' => 'ru',
                'clientOptions' => [
                   'format' => 'L',
                ],
        ]);
    ?>

    <?= $form_fields ?>
    
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


