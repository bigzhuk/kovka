<?php

/**
 * @var $this yii\web\View
 * @var $model app\models\CatalogForm
 *  @var $ar_model app\models\Catalog
 */

use app\models\Catalog;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Редактирование каталога';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-banner">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php
        require_once('../../classes/Catalog/Model/Catalog.php');
        $form_fields = '';
        $form_fields .= $form->field($model, 'name')->textInput(['value' => $ar_model->name]);
        $form_fields .= $form->field($model, 'category_id')->dropDownList(\Catalog\Model\Catalog::getKeyValCategories(), ['options' =>[$ar_model->category_id => ['Selected' => true]]]);
        $form_fields .= $form->field($model, 'subcategory_id')->dropDownList(\Catalog\Model\Catalog::$subcategories, ['options' =>[$ar_model->subcategory_id => ['Selected' => true]]]);
        $form_fields .= $form->field($model, 'art')->textInput(['value' => $ar_model->art]);
        $form_fields .= $form->field($model, 'price')->textInput(['value' => $ar_model->price]);
        $form_fields .= $form->field($model, 'description')->textarea(['value' => $ar_model->description]);
        $form_fields .= $form->field($model, 'is_active')->checkbox(['value' => $model->is_active]);
        $form_fields .= $form->field($model, 'photo[]')->fileInput(['multiple' => true, 'accept' => 'image/*']);
        $photos = explode(',', $ar_model->photo);
        $max_key = max(array_keys($photos));
            $key_row_close = 0;
            $photo_number_options = [];
            foreach ($photos as $key => $photo) {
                $photo_number = (string)($key+1);
                $photo_number_options[$photo_number] = '№'.$photo_number;
                if ($key % 4 === 0) {
                    $key_row_close = $key;
                    $form_fields .= '<div class="row" style="margin-top: 20px;">';
                }
                    $form_fields .= '<div class="col-lg-3"><img height="200" width="200" src="' . $photo . '"><br/> №'.$photo_number.'</div>';
                if (($key_row_close + 3) === $key || $max_key === $key) {
                    $form_fields .= '</div>';
                }
            }
        $model->main_photo_number = $ar_model->main_photo_number;
        $form_fields .= '<br/>'.$form->field($model, 'main_photo_number')->radioList($photo_number_options, ['separator' => '&nbsp;&nbsp;&nbsp;&nbsp;']);



    //todo сделать загрузку нескольких файлов. Здесь крестик рядом с каждой фоткой и удаления - аяксом.
    ?>


    <?= $form_fields ?>

    <div class="form-group jumbotron">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


