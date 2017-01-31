<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * CatalogForm is the model behind the catalog edit form.
 */
class CatalogForm extends Model
{

public $id;
public $name;
public $is_active;
public $description;
public $photo;
public $user_id;
public $date_update;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_active', 'description', 'photo'], 'required'],
            [['is_active', 'user_id', 'date_update'], 'integer'],
            [['description', 'photo'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'description' => 'Описание',
        ];
    }

}
