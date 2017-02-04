<?php

namespace app\models;

use yii;

/**
 * This is the model class for table "catalog".
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_id
 * @property string $art
 * @property string $price
 * @property integer $is_active
 * @property string $description
 * @property string $photo
 * @property integer $user_id
 * @property integer $date_update
 */
class Catalog extends \yii\db\ActiveRecord
{

    public static $categories = [
        1 => 'Навесы',
        2 => 'Балконы',
        3 => 'Беседки',
        4 => 'Лестницы',
        5 => 'Перила',
        6 => 'Ограды',
        7 => 'Ворота',
        8 => 'Заборы',
        9 => 'Мангалы',

    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_active', 'description', 'photo', 'art', 'price', 'category_id'], 'required'],
            [['is_active', 'user_id', 'date_update'], 'integer'],
            [['description', 'photo'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'name' => 'Имя',
            'art' => 'Артикул',
            'category_id' => 'Категория',
            'price' => 'Цена',
            'is_active' => 'Показывать на сайте?',
            'description' => 'Описание',
            'photo' => 'Фотографии',
            'user_id' => 'User ID',
            'date_update' => 'Date Update',
        ];
    }

    public function beforeSave($insert)
    {
        $this->user_id = Yii::$app->user->id;
        $this->date_update = time();
        return parent::beforeSave($insert);
    }
}
