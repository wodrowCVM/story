<?php
/**
 * @var \yii\web\View $this
 * @var \frontend\models\ActiveForEmailForm $model
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = '发送激活链接';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-active-for-email">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-active-for-email']); ?>
            <?= $form->field($model, 'email')->textInput() ?>
            <?= $form->field($model, 'code')->widget(\yii\captcha\Captcha::className()) ?>
            <div class="form-group">
                <?= Html::submitButton('发送', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                <?=Html::resetButton("重置", ['class' => 'btn btn-warning']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>