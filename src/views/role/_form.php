<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use M91\UserModule\Module;
use kartik\select2\Select2;
use yii\rbac\Item;

/* @var $this yii\web\View */
/* @var $model M91\UserModule\models\Role */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="role-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['disabled' => !$model->isNewRecord()]) ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'subRoles')->widget(Select2::classname(), [
        'data' => $model->getAuthItems(Item::TYPE_ROLE),
        'options' => [
            'placeholder' => Module::t('app', 'Select'),
            'multiple' => true
        ],
        'pluginOptions' => [
            'tags' => true,
            'tokenSeparators' => [',', ' '],
        ],
    ]);
    ?>

     <?= $form->field($model, 'permissions')->widget(Select2::classname(), [
        'data' => $model->getAuthItems(Item::TYPE_PERMISSION),
        'options' => [
            'placeholder' => Module::t('app', 'Select'),
            'multiple' => true
        ],
        'pluginOptions' => [
            'tags' => true,
            'tokenSeparators' => [',', ' '],
        ],
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton(Module::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
