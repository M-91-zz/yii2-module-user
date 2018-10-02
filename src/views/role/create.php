<?php

use yii\helpers\Html;
use marcelodeandrade\UserModule\Module;

/* @var $this yii\web\View */
/* @var $model marcelodeandrade\UserModule\models\Role */

$this->title = Module::t('app', 'Create Role');
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
