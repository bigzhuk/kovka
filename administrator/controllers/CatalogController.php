<?php

namespace app\controllers;

use app\models\Banner;
use app\models\BannerForm;
use app\models\Catalog;
use app\models\CatalogForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;

class CatalogController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $category_id = Yii::$app->request->get('category_id');
        $query = $category_id ? Catalog::find()->andFilterWhere(['category_id' => $category_id]) : Catalog::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('list', ['data_provider' => $dataProvider, 'selected_category_id' => $category_id]);
    }

    public function actionUpdate()
    {
        $form = new CatalogForm();
        $id = Yii::$app->request->get('id');
        $model = empty($id)
            ? new Catalog()
            : Catalog::findOne(['id' => $id]);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            if (!is_null($model)) {
                $model->name = Html::encode($form->name);
                $model->category_id = (int)$form->category_id;
                $model->subcategory_id = (int)$form->subcategory_id;
                $model->art = Html::encode($form->art);
                $model->price = Html::encode($form->price);
                $model->description = Html::encode($form->description);
                $model->is_active = ($form->is_active === 'on') ? 1 : 0;
                $model->main_photo_number = (int)$form->main_photo_number;
                $model->price_int = (int)preg_replace('/[^0-9]+/', '', $form->price);
                $form->photo = UploadedFile::getInstances($form, 'photo');
                if ($model->id) {
                    $product_id = $model->id;
                } else {
                   $max_product_id = Catalog::find()
                       ->select('id')
                       ->max('id');
                   $product_id = $max_product_id ? ++$max_product_id : 1;
                }

                if ($form->upload($model->category_id, $product_id)) {
                    $photos = [];
                    foreach($form->photo as $photo) {
                        $photos[] = $form->getUploadFilePath(
                            $photo,
                            $form->getProductFolderName($model->category_id, $product_id)
                        );
                    }
                    $model->photo = implode(',', $photos);
                }

                if (!$model->save()) {
                    var_dump($model->getErrors());
                    die;
                }
                $this->redirect('index.php?r=catalog');
            }
        }
        
        return $this->render('update', ['model' => $form, 'id' => $id, 'ar_model' => $model]);
    }

    public function actionDelete()
    {
        $id = Yii::$app->request->get('id');
        if ($id) {
            Catalog::deleteAll(['id' => $id]);
        }
        $this->redirect('index.php?r=catalog');
    }


}
