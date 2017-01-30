<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * BannerForm is the model behind the banner edit form.
 */
class BannerForm extends Model
{

public $id;
public $title;
public $banner_text;
public $user_id;
public $date_publish_start;
public $date_publish_end;
public $date_update;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [
                ['title', 'banner_text', 'date_publish_start', 'date_publish_end'], 'required'
            ],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'banner_text' => 'Текст объявления',
            'date_publish_start' => 'Начало публикации',
            'date_publish_end' => 'Конец публикации'
        ];
    }

}
