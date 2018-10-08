<?php

use yii\helpers\Html;
use M91\UserModule\Module;

/* @var $this yii\web\View */
/* @var $role M91\UserModule\models\Role */

$this->title = Module::t('app', 'Role: ' . $role->name, [
    'nameAttribute' => '' . $role->name,
]);
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $role->name, 'url' => ['view', 'id' => $role->name]];
$this->params['breadcrumbs'][] = Module::t('app', 'Update');
?>
<div class="role-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    var_dump($permissions);
    ?>

</div>
