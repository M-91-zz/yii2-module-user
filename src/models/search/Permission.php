<?php

namespace M91\UserModule\models\search;

use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\rbac\Item;
use M91\UserModule\models\Permission as PermissionBase;

class Permission extends PermissionBase
{
    public $authManager;

    public function __construct()
    {
        $this->authManager = Yii::$app->authManager;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'string'],
        ];
    }

    /**
     * @param array $params
     * @return ArrayDataProvider
     */
    public function search($params = [])
    {
        $dataProvider = new ArrayDataProvider;

        $query = (new Query)
            ->select('*')
            ->from($this->authManager->itemTable)
            ->andWhere(['type' => $this->type])
            ->andWhere(['name' => $this->name]);

        $dataProvider->allModels = $query->all();

        return $dataProvider;
    }
}
