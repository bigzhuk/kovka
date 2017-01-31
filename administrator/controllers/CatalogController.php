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
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
        $dataProvider = new ActiveDataProvider([
            'query' => Catalog::find()
        ]);
        return $this->render('list', ['data_provider' => $dataProvider]);
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
                $model->description = Html::encode($form->description);
                $model->is_active = strtotime($form->is_active);
                $model->photo = strtotime($form->photo);
                $model->save();
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
