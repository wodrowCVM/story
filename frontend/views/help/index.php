<?php
/**
 * @var \yii\web\View $this
 */
$this->title = "帮助中心";
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="help-index">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    如何获取邀请码
                </div>
                <!-- .panel-heading -->
                <div class="panel-body">
                    详情请见<?=\yii\helpers\Html::a('获取邀请码', ['/help/how-to-get-auth-code']) ?>
                </div>
                <!-- .panel-body -->
            </div>
        </div>
    </div>
</div>