<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * BannerForm is the model behind the banner edit form.
 */
class BannerForm extends Model
{

public $title;
public $text;
public $date_publish_start;
public $date_publish_end;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['title', 'text', 'date_publish_start', 'date_publish_end'], 'required'],
        ];
    }
}
