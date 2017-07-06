<?php
/**
 * @var \yii\web\View $this
 * @var \common\models\User $user
 */
$this->title = "用户中心";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-index">
    <div class="row">
        <div class="col-sm-12">
            <?=\kartik\detail\DetailView::widget([
                'model'=>$user,
                'condensed'=>true,
                'hover'=>true,
                'mode'=>\kartik\detail\DetailView::MODE_VIEW,
                'attributes'=>[
                    'username',
                    'email',
                    'created_at:datetime',
                    'updated_at:datetime',
                    [
                        'attribute' => 'status',
                        'value' => $user::getStatus()[$user->status],
                    ],
                    'money',
                    'integral',
                    'xp',
                ]
            ]) ?>
            <?php $form = \yii\bootstrap\ActiveForm::begin(); ?>
            <?=$form->field($user, 'mobile')->textInput(); ?>
            <?=$form->field($user, 'nickname')->textInput(); ?>
            <?=$form->field($user, 'qq')->textInput(); ?>
            <?=$form->field($user, 'weibo')->textInput(); ?>
            <?=$form->field($user, 'sex')->dropDownList($user::getSex()); ?>
            <?=\yii\helpers\Html::submitButton("保存", ['class'=>"btn btn-primary"]) ?>
            <?=\yii\helpers\Html::resetButton("重置", ['class'=>"btn btn-warning"]) ?>
            <?php \yii\bootstrap\ActiveForm::end(); ?>
        </div>
    </div>
</div>