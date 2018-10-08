<?php

namespace M91\UserModule\models\search;

use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\rbac\Item;
use M91\UserModule\models\Role as RoleBase;

class Role extends RoleBase
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
            ->andWhere(['type' => $this->type])
            ->from($this->authManager->itemTable);

        $dataProvider->allModels = $query->all();

        return $dataProvider;
    }

}
