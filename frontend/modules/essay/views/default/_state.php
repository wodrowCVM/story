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
            <a href="#" class="list-group-item">
                <i class="fa fa-comment fa-fw"></i> New Comment
                <span class="pull-right text-muted small"><em>4 minutes ago</em></span>
            </a>
        </div>
        <!-- /.list-group -->
        <?= \yii\helpers\Html::a('我要写随笔', ['/user/essay/create'], ['class' => "btn btn-primary btn-block"]) ?>
    </div>
    <!-- /.panel-body -->
</div>
