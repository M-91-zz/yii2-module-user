<?php

namespace marcelodeandrade\UserModule\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use marcelodeandrade\UserModule\Module;
use marcelodeandrade\UserModule\models\search\Role as RoleSearch;
use marcelodeandrade\UserModule\models\Role;
use marcelodeandrade\UserModule\filters\AccessRule;

class RoleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ]
        ];
    }

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
