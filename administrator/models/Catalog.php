<?php

namespace app\models;

use yii;

/**
 * This is the model class for table "catalog".
 *
 * @property integer $id
 * @property string $name
 * @property integer $is_active
 * @property string $description
 * @property string $photo
 * @property integer $user_id
 * @property integer $date_update
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
            [['is_active', 'description', 'photo'], 'required'],
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
