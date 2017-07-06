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
public $subcategory_id;
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
            [['user_id', 'date_update', 'subcategory_id'], 'integer'],
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
            'subcategory_id' => 'Подкатегория',
            'price' => 'Цена',
            'description' => 'Описание',
            'is_active' => 'Показывать товар?',
            'photo' => 'Фотографии'
        ];
    }

    public function upload($category_id, $product_id)
    {
        require_once('../../classes/Catalog/Helper/SimpleImage.php');
        if (empty($this->photo)) {
            return false;
        }
        if ($this->validate()) {
            $product_img_folder = $this->getProductFolderName($category_id, $product_id);
            self::deleteDir('../uploads/'.$product_img_folder); // удаляем все директорию продукта со всеми файлами и thumb'ами
            mkdir('../uploads/'.$product_img_folder); // создаем директорию продукта, куда будем скалдывать фото

            $product_thumbs_folder = $this->getProductThumbsFolderName($category_id, $product_id);
            mkdir('../uploads/'.$product_thumbs_folder); // внутри директории продукта создаем поддиректорию для thumb'ов

            $image = new \Catalog\Helper\SimpleImage();
            foreach ($this->photo as $file) {
                // сохраняем основной файл
                $file_path = $this->getUploadFilePath($file, $product_img_folder);
                $file->saveAs($file_path);

                // сохраняем thumbs
                $file_thumb_path = $this->getUploadFilePath($file, $product_thumbs_folder);
                $image->load($file_path);
                $image->resize(200, 200);
                $image->save($file_thumb_path);
            }
            return true;
        } else {
            return false;
        }
    }

    public function getUploadFilePath($file, $folder) {
        return '../uploads/'.$folder.'/'.$file->baseName . '.' . $file->extension;
    }

    private function getCategoryFolderName($category_id) {
        require_once('../../classes/Catalog/Model/Catalog.php');
        return \Catalog\Model\Catalog::getPhotoUploadFolderName($category_id);
    }

    public function getProductFolderName($category_id, $product_id) {
        return $this->getCategoryFolderName($category_id).'/'.$product_id;
    }

    public function getProductThumbsFolderName($category_id, $product_id) {
        return $this->getCategoryFolderName($category_id).'/'.$product_id.'/thumbs';
    }

    public static function deleteDir($dirPath) {
        if (!is_dir($dirPath)) {
            return false;
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) !== '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }

}
