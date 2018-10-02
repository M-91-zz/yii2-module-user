<?php

namespace marcelodeandrade\UserModule\controllers;

use Yii;
use yii\web\Controller;
use marcelodeandrade\UserModule\models\search\Role as RoleSearch;
use marcelodeandrade\UserModule\models\Role;

class RoleController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new RoleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Role();

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
            Yii::$app->session->setFlash('success', "Role created successfuly");
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
}
