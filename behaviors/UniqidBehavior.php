<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\Page;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    public function actionPage($slug = 'index')
    {
        $model = Page::findOne([
            'slug' => $slug,
            'is_disabled' => false,
        ]);

        if (!$model)
            throw new NotFoundHttpException('Страница не найдена');

        return $this->render('page', [
            'model' => $model,
        ]);
    }
}
