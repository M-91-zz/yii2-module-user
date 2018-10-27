<?php

use yii\helpers\Html;
use M91\UserModule\Module;

/* @var $this yii\web\View */
/* @var $model M91\UserModule\models\Permission */

$this->title = Module::t('app', 'Create Permission');
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Permissions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginContent('@M91/UserModule/views/layout.php') ?>

<div class="permission-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php $this->endContent() ?>
