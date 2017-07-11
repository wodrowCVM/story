<?php
/**
 * @var \yii\web\View $this
 */
$this->beginContent('@frontend/views/layouts/base.php');
?>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-4">
                <?=\common\components\rewrite\kartik\widgets\SideNav::widget([
                    'type' => \kartik\sidenav\SideNav::TYPE_DEFAULT,
                    'heading' => '菜单',
                    'items' => [
                        [
                            'url' => ['/user/default/index'],
                            'label' => '用户信息',
                            'icon' => 'user'
                        ],
                        [
                            'url' => ['/user/default/reset-password'],
                            'label' => '重置密码',
                            'icon' => 'lock'
                        ],
                        [
                            'url' => ['/user/essay/index'],
                            'label' => '随笔管理',
                            'icon' => 'file'
                        ],
                        [
                            'url' => ['/user/novel/index'],
                            'label' => '小说管理',
                            'icon' => 'book'
                        ],
                        [
                            'url' => ['/user/alert/index'],
                            'label' => '我的提醒',
                            'icon' => 'bell'
                        ],
                        /*[
                            'label' => 'Help',
                            'icon' => 'question-sign',
                            'items' => [
                                ['label' => 'About', 'icon'=>'info-sign', 'url'=>'#'],
                                ['label' => 'Contact', 'icon'=>'phone', 'url'=>'#'],
                            ],
                        ],*/
                    ],
                ]) ?>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-8">
                <?= \yii\widgets\Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'encodeLabels' => false,
                ]) ?>
                <?= \common\widgets\Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
    </div>
<?php $this->endContent() ?>