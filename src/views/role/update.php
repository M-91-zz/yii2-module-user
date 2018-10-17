<?php

use yii\helpers\Html;
use M91\UserModule\Module;

/* @var $this yii\web\View */
/* @var $model M91\UserModule\models\Role */

$this->title = Module::t('app', 'Update Role: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'name' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('app', 'Update');
?>

<?php $this->beginContent('@M91/UserModule/views/layout.php') ?>

<div class="role-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php $this->endContent() ?>
