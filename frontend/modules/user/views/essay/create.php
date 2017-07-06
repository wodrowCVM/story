<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\user\models\Essay */

$this->title = '新建随笔';
$this->params['breadcrumbs'][] = ['label' => '个人中心', 'url' => ['/user']];
$this->params['breadcrumbs'][] = ['label' => '随笔列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="essay-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
