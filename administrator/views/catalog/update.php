<?php

/**
 * @var $this yii\web\View
 * @var $model app\models\CatalogForm
 *  @var $ar_model app\models\Catalog
 */

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
        $form_fields .= $form->field($model, 'name')->textInput(['value' => $ar_model->name]);
        $form_fields .= $form->field($model, 'description')->textInput(['value' => $ar_model->description]);
        $form_fields .= $form->field($model, 'is_active')->checkbox(['value' => $ar_model->is_active]);
    ?>

    <?= $form_fields ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>


