<?php
/**
 * @var \yii\web\View $this
 */
$this->title = "如何获取授权码";
$this->params['breadcrumbs'][] = \yii\helpers\Html::a('帮助中心', ['/help']);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="help-how-to-get-auth-code">
    <div class="row">
        <div class="col-sm-12">
            <p>
                你可以直接qq联系我，QQ：<code><?=Config::$adminQQ ?></code>，备注： <code>我要加入<?=Yii::$app->name ?></code>。
            </p>
            <p>
                你可以加入qq群询问管理员来获取授权码：
                <?php foreach (Config::$appQQGroups as $k => $v): ?>
                    <code><?=$v['number'] ?></code>[<?=$v['status'] ?>]
                <?php endforeach; ?>
            </p>
        </div>
    </div>
</div>
