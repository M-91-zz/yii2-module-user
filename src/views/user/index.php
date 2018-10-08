<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use M91\UserModule\Module;
use M91\UserModule\models\User;

/* @var $this yii\web\View */
/* @var $searchModel M91\UserModule\models\search\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Module::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'username',
            'email:email',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->statusLabel();
                },
                'filter' => User::statusLabelList(),
            ],
            'superadmin:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
