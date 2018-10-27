<?php

namespace M91\UserModule\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ArrayDataProvider;
use M91\UserModule\Module;
use M91\UserModule\models\search\Permission as PermissionSearch;
use M91\UserModule\models\search\AuthItem as AuthItemSearch;
use M91\UserModule\models\Permission;
use M91\UserModule\models\AuthItem;
use M91\UserModule\filters\AccessRule;
use yii\rbac\Item;

class PermissionController extends Controller
{
    /**
     * @var \yii\rbac\ManagerInterface $authManager
     */
    protected $authManager;

    /**
     * @var int
     */
    protected $type = Item::TYPE_PERMISSION;

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

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->authManager = Yii::$app->authManager;
    }

    public function actionIndex()
    {
        $searchModel = new AuthItemSearch();
        $searchModel->type = $this->type;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new AuthItem();
        $model->type = $this->type;

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
            Yii::$app->session->setFlash('success', Module::t('app', 'Permission created successfully'));
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate(string $name)
    {
        $model = $this->findModel($name);

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
            Yii::$app->session->setFlash('success', Module::t('app', 'Permission update successfully'));
            return $this->redirect(['index']);
        }
        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete(string $name)
    {
        $permission = $this->authManager->getPermission($name);

        if ($permission !== null && $this->authManager->remove($permission)) {
            Yii::$app->session->setFlash('success', Module::t('app', 'Permission deleted successfully'));
        }

        $this->redirect(['index']);
    }

    protected function findModel(string $name)
    {
        $permission = $this->authManager->getPermission($name);

        if (empty($permission)) {
            throw new \yii\web\NotFoundHttpException();
        }

        return new AuthItem($permission);
    }
}
