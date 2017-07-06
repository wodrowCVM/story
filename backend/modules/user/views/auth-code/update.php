<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\UserAuthCode */

$this->title = 'Update User Auth Code: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Auth Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-auth-code-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
