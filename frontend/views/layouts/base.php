<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\bootstrap\NavBar;
use frontend\assets\AppAsset;
\kartik\icons\Icon::map($this);
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
//            'class' => 'navbar-fixed-top',
            'style' => [
                'box-shadow' => "0 1px 1px rgba(0,0,0,0.11)",
            ],
        ],
    ]);
    $leftItems = [
        ['label' => '随笔', 'url' => ['/essay']],
        ['label' => '小说', 'url' => ['/novel']],
    ];
    if (Yii::$app->user->isGuest) {
        $rightItems[] = ['label' => '注册', 'url' => ['/site/signup']];
        $rightItems[] = ['label' => '登录', 'url' => ['/site/login']];
    } else {
        $user_alert = new \common\models\UserAlert();
        $notifyCount = $user_alert::find()->where(['to_user'=>Yii::$app->user->id, 'status'=>$user_alert::STATUS_UNREAD])->count();
        $rightItems[] = [
            'label' => Html::tag('i', '', ['class' => 'fa fa-bell']) . Html::tag('span', $notifyCount ? $notifyCount : null),
            'url' => $user_alert->urls['list'],
            'linkOptions' => ['class' => $notifyCount ? 'new' : null],
            'options' => ['class' => 'notification-count'],
        ];
        $rightItems[] = [
            'label' => Yii::$app->user->identity->username,
            'items' => [
                ['label' => '我的主页', 'url' => ['/user']],
//                ['label' => '帐号设置', 'url' => ['/user/default/set']],
                ['label' => '退出', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']]
            ],
            'linkOptions'=>[
                'class'=>'avatar',
            ],
        ];
    }
    echo \common\components\rewrite\bootstrap\Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $leftItems,
        'activateParents' => true,
//    'activateItems' => false,
        'encodeLabels' => false,
    ]);
    echo \common\components\rewrite\bootstrap\Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $rightItems,
        'activateParents' => true,
//    'activateItems' => false,
        'encodeLabels' => false,
    ]);
    NavBar::end();
    ?>
    <?=$content ?>
</div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?=Yii::$app->name ?> <?= date('Y') ?></p>
        <p class="pull-left" style="margin-left: 2em;"></p>
        <p class="pull-left"><?=Html::a('帮助中心', ['/help']) ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
