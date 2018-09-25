<?php

use yii\helpers\Html;
use marcelodeandrade\UserModule\Module;

/* @var $this yii\web\View */
/* @var $model marcelodeandrade\UserModule\models\User */

$this->title = Module::t('app', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
