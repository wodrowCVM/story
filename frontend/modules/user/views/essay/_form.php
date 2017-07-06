<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\user\models\Essay */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'BindEssayTag', 
        'relID' => 'bind-essay-tag', 
        'value' => \yii\helpers\Json::encode($model->bindEssayTags),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="essay-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model); ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => '标题']) ?>
    <?= $form->field($model, 'desc')->textInput(['maxlength' => true, 'placeholder' => '随笔简介']) ?>
    <?= $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className(), [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'zh_cn',
            'buttons'=>['html', 'bold', 'italic', 'deleted', 'link', 'horizontalrule'],
            'plugins' => ['fontcolor','imagemanager'],
//            'minHeight'=>400,
        ],
    ]) ?>
    <?= $form->field($model, 'type')->dropDownList($model::getType()) ?>
    <?= $form->field($model, 'status')->dropDownList($model::getStatus()) ?>
    <?= $form->field($model, 'need_money')->textInput(['placeholder' => '获取随笔需要扣除的金币']) ?>
    <?= $form->field($model, 'need_integral')->textInput(['placeholder' => '获取随笔需要扣除的积分']) ?>
    <?= $form->field($model, 'need_xp')->textInput(['placeholder' => '需要达到的经验值']) ?>
    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('标签'),
            'content' => $this->render('_formBindEssayTag', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->bindEssayTags),
            ]),
        ],
    ];
    echo kartik\tabs\TabsX::widget([
        'items' => $forms,
        'position' => kartik\tabs\TabsX::POS_ABOVE,
        'encodeLabels' => false,
        'pluginOptions' => [
            'bordered' => true,
            'sideways' => true,
            'enableCache' => false,
        ],
    ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
