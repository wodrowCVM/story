<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\UserAuthCode */

$this->title = 'Save As New User Auth Code: '. ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Auth Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="user-auth-code-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
