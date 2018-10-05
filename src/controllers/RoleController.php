<?php

namespace marcelodeandrade\UserModule\controllers;

use Yii;
use yii\web\Controller;
use marcelodeandrade\UserModule\models\search\Role as RoleSearch;
use marcelodeandrade\UserModule\models\Role;
use marcelodeandrade\UserModule\Module;

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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Module::t('app', 'Role created successfully'));
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionDelete(string $name)
    {
        $authManager = Yii::$app->authManager;
        $role = $authManager->getRole($name);

        if ($role !== null && $authManager->remove($role)) {
            Yii::$app->session->setFlash('success', Module::t('app', 'Role deleted successfully'));
        }

        $this->redirect(['index']);
    }
}
