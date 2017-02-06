<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * CatalogForm is the model behind the catalog edit form.
 */
class CatalogForm extends Model
{

public $id;
public $name;
public $category_id;
public $art;
public $price;
public $is_active;
public $description;
/**
 * @var UploadedFile[]
 */
public $photo;
public $user_id;
public $date_update;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_active', 'description', 'art', 'price', 'category_id'], 'required'],
            [['user_id', 'date_update'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['photo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 8],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'art' => 'Артикул',
            'category_id' => 'Категория',
            'price' => 'Цена',
            'description' => 'Описание',
            'is_active' => 'Показывать товар?',
            'photo' => 'Фотографии'
        ];
    }

    public function upload()
    {
        if (empty($this->photo)) {
            return false;
        }
        if ($this->validate()) {
            foreach ($this->photo as $file) {
                $file->saveAs($this->getUploadFilePath($file));
            }
            return true;
        } else {
            return false;
        }
    }

    public function getUploadFilePath($file) {
        return '../uploads/' . $file->baseName . '.' . $file->extension;
    }

}
