<?php

namespace M91\UserModule\controllers;

use Yii;
use yii\web\Controller;
use M91\UserModule\models\LoginForm;

class AuthController extends Controller
{
    public function actionIndex()
    {
        return "Auth";
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
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
}
