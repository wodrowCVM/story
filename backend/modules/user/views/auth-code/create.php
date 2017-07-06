<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\UserAuthCode */

$this->title = '生成授权码';
$this->params['breadcrumbs'][] = ['label' => 'User Auth Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-auth-code-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
