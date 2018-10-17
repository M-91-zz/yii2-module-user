<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use M91\UserModule\Module;

$this->title = Module::t('app', 'Role: ' . $role->name, [
    'nameAttribute' => '' . $role->name,
]);
$this->params['breadcrumbs'][] = ['label' => Module::t('app', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $role->name, 'url' => ['view', 'name' => $role->name]];
$this->params['breadcrumbs'][] = Module::t('app', 'Update');
?>

<?php $this->beginContent('@M91/UserModule/views/layout.php') ?>

<div class="role-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= ListView::widget([
        'layout' => '<h2>Permissions</h2>{items}',
        'dataProvider' => $permissions,
        'itemView' => '_permission',
    ]);
    ?>

</div>

<?php $this->endContent() ?>
