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

$this->title = Module::t('app', 'Permissions');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginContent('@M91/UserModule/views/layout.php') ?>

<div class="user-index">

    <?php Pjax::begin(); ?>

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
                    return Url::to(['permission/' . $action, 'name' => $model['name']]);
                }
            ]
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

<?php $this->endContent() ?>