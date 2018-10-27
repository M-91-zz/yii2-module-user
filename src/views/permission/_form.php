<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use M91\UserModule\Module;
use kartik\select2\Select2;
use yii\rbac\Item;

/* @var $this yii\web\View */
/* @var $model M91\UserModule\models\Permission */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permission-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['disabled' => !$model->isNewRecord()]) ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Module::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
