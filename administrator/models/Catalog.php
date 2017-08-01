<?php

namespace app\models;

use yii;

/**
 * This is the model class for table "catalog".
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_id
 * @property integer $subcategory_id
 * @property integer $main_photo_number
 * @property string $art
 * @property string $price
 * @property integer $is_active
 * @property string $description
 * @property string $photo
 * @property integer $user_id
 * @property integer $date_update
 * @property integer $price_int
 */
class Catalog extends \yii\db\ActiveRecord
{

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
            [['user_id', 'date_update', 'subcategory_id', 'main_photo_number', 'price_int'], 'integer'],
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
            'subcategory_id' => 'Подкатегория',
            'main_photo_number' => 'Номер главной фотографии',
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
