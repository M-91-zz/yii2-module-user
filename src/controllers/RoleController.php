<?php

namespace marcelodeandrade\UserModule\controllers;

use Yii;
use yii\web\Controller;
use marcelodeandrade\UserModule\models\search\Role as RoleSearch;

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
}
