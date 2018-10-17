<?php

use yii\helpers\Html;
use M91\UserModule\Module;

/* @var $this yii\web\View */
/* @var $model M91\UserModule\models\Role */

$this->title = Module::t('app', 'Create Role');
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginContent('@M91/UserModule/views/layout.php') ?>

<div class="role-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php $this->endContent() ?>
