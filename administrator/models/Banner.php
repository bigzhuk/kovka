<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Class Banner
 * @package app\models
 * @property $id
 * @property $title
 * @property $banner_text
 * @property $user_id
 * @property $date_publish_start
 * @property $date_publish_end
 * @property $date_update
 *
 */
class Banner extends ActiveRecord {

    public static function tableName()
    {
        return 'banner';
    }

    public function beforeSave($insert)
    {
        $this->user_id = Yii::$app->user->id;
        $this->date_update = time();
        return parent::beforeSave($insert);
    }

}