<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\tag\models\Tag */
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

<div class="tag-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model); ?>
    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'desc')->textarea() ?>
    <?= $form->field($model, 'type')->dropDownList($model::getType()) ?>
    <?= $form->field($model, 'status')->dropDownList($model::getStatus()) ?>
    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('BindEssayTag'),
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
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create'): Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
