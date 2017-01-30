<?php

namespace app\controllers;

use app\models\Banner;
use app\models\BannerForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class BannerController extends Controller
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
            'query' => Banner::find()
        ]);
        return $this->render('list', ['data_provider' => $dataProvider]);
    }

    public function actionUpdate()
    {
        $form = new BannerForm;
        $id = Yii::$app->request->get('id');
        $model = empty($id)
            ? new Banner()
            : Banner::findOne(['id' => $id]);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            if (!is_null($model)) {
                $model->title = Html::encode($form->title);
                $model->banner_text = Html::encode($form->banner_text);
                $model->date_publish_start = strtotime($form->date_publish_start);
                $model->date_publish_end = strtotime($form->date_publish_end);
                $model->save();
            }
        }

        return $this->render('update', ['model' => $form, 'id' => $id, 'ar_model' => $model]);
    }
   

}
