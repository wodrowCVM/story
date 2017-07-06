<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\user\models\EssaySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-essay-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id')->textInput(['placeholder' => 'Id']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => 'Title']) ?>

    <?= $form->field($model, 'desc')->textInput(['maxlength' => true, 'placeholder' => 'Desc']) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'type')->textInput(['placeholder' => 'Type']) ?>

    <?php /* echo $form->field($model, 'status')->textInput(['placeholder' => 'Status']) */ ?>

    <?php /* echo $form->field($model, 'need_money')->textInput(['placeholder' => 'Need Money']) */ ?>

    <?php /* echo $form->field($model, 'need_integral')->textInput(['placeholder' => 'Need Integral']) */ ?>

    <?php /* echo $form->field($model, 'need_xp')->textInput(['placeholder' => 'Need Xp']) */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
