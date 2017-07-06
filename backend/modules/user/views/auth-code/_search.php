<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\UserAuthCodeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-user-auth-code-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bind_user')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\backend\modules\user\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => [],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'bind_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\backend\modules\user\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => [],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?php echo $form->field($model, 'created_at')->textInput()  ?>

    <?php echo $form->field($model, 'updated_by')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\backend\modules\user\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => [],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?php echo $form->field($model, 'updated_at')->textInput()  ?>

    <?php echo $form->field($model, 'status')->dropDownList($model::getStatus()) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
