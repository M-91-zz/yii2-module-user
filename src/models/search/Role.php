<?php

namespace marcelodeandrade\UserModule\models\search;

use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\rbac\Item;

class Role extends Model
{
    /**
     * @var [string]
     */
    public $name;

    /**
     * @var [string]
     */
    public $description;

    /**
     * @var [string]
     */
    public $type;

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
            ->andWhere(['type' => Item::TYPE_ROLE])
            ->from($this->authManager->itemTable);

        $dataProvider->allModels = $query->all();

        return $dataProvider;
    }

}
