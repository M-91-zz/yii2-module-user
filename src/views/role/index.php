<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use M91\UserModule\Module;
use M91\UserModule\models\User;

/* @var $this yii\web\View */
/* @var $searchModel M91\UserModule\models\search\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('app', 'Roles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Module::t('app', 'Create Role'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'layout' => "{items}\n{pager}",
        'columns' => [
            'name',
            'description',
            [
                'class'      => 'yii\grid\ActionColumn',
                'template'   => '{update} {delete}',
                'urlCreator' => function ($action, $model) {
                    return Url::to(['role/' . $action, 'name' => $model['name']]);
                }
            ]
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
