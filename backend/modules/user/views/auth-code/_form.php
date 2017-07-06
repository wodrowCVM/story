<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this yii\web\View
 * @var backend\modules\user\models\UserAuthCode $model
 * @var $form yii\widgets\ActiveForm
 */

?>

<div class="user-auth-code-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id')->textInput(['placeholder' => '自动生成', 'readonly'=>true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true, 'placeholder' => '自动生成', 'readonly'=>true]) ?>

    <?= $model->isNewRecord?'':$form->field($model, 'bind_user')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\backend\modules\user\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => '选择用户'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'status')->dropDownList($model::getStatus()) ?>

    <div class="form-group">
    <?php if(Yii::$app->controller->action->id != 'save-as-new'): ?>
        <?= Html::submitButton($model->isNewRecord ? '创建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?php endif; ?>
    <?php if(Yii::$app->controller->action->id != 'create'): ?>
        <?php // Html::submitButton('Save As New', ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew']) ?>
    <?php endif; ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
