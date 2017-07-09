<?php
/**
 * @var \yii\web\View $this
 */
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-th fa-fw"></i> 个人动态
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="list-group">
            <a href="<?=\yii\helpers\Url::to(['/user/essay']) ?>" class="list-group-item">
                <?=\kartik\icons\Icon::show('circle-thin') ?> 我的创作
                <span class="pull-right text-muted small"><em><code><?=\common\models\Essay::find()->where(['created_by'=>Yii::$app->user->id])->count() ?></code></em></span>
            </a>
            <a href="<?=\yii\helpers\Url::to(['/user/essay/get-buy']) ?>" class="list-group-item">
                <?=\kartik\icons\Icon::show('circle-thin') ?> 已获取的随笔
                <span class="pull-right text-muted small"><em><code>0</code></em></span>
            </a>
        </div>
        <!-- /.list-group -->
        <?= \yii\helpers\Html::a('我要写随笔', ['/user/essay/create'], ['class' => "btn btn-primary btn-block"]) ?>
    </div>
    <!-- /.panel-body -->
</div>
