<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model id5\rbac\models\User */

$this->title = Yii::t('id5.rbac', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('id5.rbac', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
