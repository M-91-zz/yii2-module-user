<?php

namespace M91\UserModule\models\search;

use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\rbac\Item;
use M91\UserModule\models\AuthItem as AuthItemBase;

class AuthItem extends AuthItemBase
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
        $query = (new Query)
            ->select('*')
            ->andWhere(['type' => $this->type])
            ->from($this->authManager->itemTable);

        return new ArrayDataProvider([
            'allModels' => $query->all(),
            'sort' => [
                'attributes' => ['name'],
            ],
            // 'pagination' => [
            //     'pageSize' => 100,
            // ],
        ]);
    }
}
