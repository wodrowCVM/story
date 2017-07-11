<?php
/**
 * @var \yii\web\View $this
 * @var \frontend\models\SigninForm $signinForm
 */
$this->title = '首页';
$diskData = \common\components\tools\ServerInfo::getDiskData();
$diskTotal = $diskData['iTotal'];
$diskUseless = $diskData['iUsableness'];
$diskUse = $diskTotal - $diskUseless;
$tips = \common\models\Tips::find()->orderBy('RAND()')->one();
?>
<div class="site-index">
    <?php
    //    var_dump(Yii::$app->user->identity->userAuthCodes[0]);
    ?>
    <div class="body-content">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <?= \kartik\icons\Icon::show('users', ['class' => 'fa-5x']) ?>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?= \common\models\User::find()->count() ?></div>
                                <div>用户数</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?=Yii::$app->user->identity->urls['list'] ?>">
                        <div class="panel-footer">
                            <span class="pull-left">查看</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <?= \kartik\icons\Icon::show('file', ['class' => 'fa-5x']) ?>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?=\common\models\Essay::find()->where(['status'=>\common\models\Essay::STATUS_ACTIVE])->count() ?></div>
                                <div>随笔数</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?=\yii\helpers\Url::toRoute(['/essay']) ?>">
                        <div class="panel-footer">
                            <span class="pull-left">查看</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <?= \kartik\icons\Icon::show('book', ['class' => 'fa-5x']) ?>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">0</div>
                                <div>小说数</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?=\yii\helpers\Url::to(['/novel']) ?>">
                        <div class="panel-footer">
                            <span class="pull-left">查看</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <?= \kartik\icons\Icon::show('tags', ['class' => 'fa-5x']) ?>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?=\common\models\Tag::find()->count() ?></div>
                                <div>标签数</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">查看</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        空间使用状况(单位:GB)
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="flot-chart">
                            <?= \dosamigos\chartjs\ChartJs::widget([
                                'type' => 'pie',
                                'data' => [
                                    'labels' => [
                                        "已使用",
                                        "未使用",
                                    ],
                                    'datasets' => [
                                        [
                                            'label' => '空间使用状况',
                                            'data' => [
                                                $diskUse,
                                                $diskUseless,
                                            ],
                                            'backgroundColor' => [
                                                'rgba(255, 99, 132, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                            ],
                                            'borderColor' => [
                                                'rgba(255,99,132,1)',
                                                'rgba(54, 162, 235, 1)',
                                            ],
                                            'borderWidth' => 1
                                        ]
                                    ]
                                ]]);
                            ?>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        你的贡献
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="flot-chart">
                            <?= \dosamigos\chartjs\ChartJs::widget([
                                'type' => 'bar',
                                'data' => [
                                    'labels' => ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                                    'datasets' => [
                                        [
                                            'label' => '# of Votes',
                                            'data' => [12, 19, 3, 5, 2, 3],
                                            'backgroundColor' => [
                                                'rgba(255, 99, 132, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(255, 206, 86, 0.2)',
                                                'rgba(75, 192, 192, 0.2)',
                                                'rgba(153, 102, 255, 0.2)',
                                                'rgba(255, 159, 64, 0.2)'
                                            ],
                                            'borderColor' => [
                                                'rgba(255,99,132,1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(255, 206, 86, 1)',
                                                'rgba(75, 192, 192, 1)',
                                                'rgba(153, 102, 255, 1)',
                                                'rgba(255, 159, 64, 1)'
                                            ],
                                            'borderWidth' => 1
                                        ]
                                    ]
                                ]]);
                            ?>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bell fa-fw"></i> 消息
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <?= \kartik\icons\Icon::show('magic') ?>小贴士
                                    </div>
                                    <div class="panel-body">
                                        <?php if(!$tips): ?>
                                            <p style="text-indent: 2em;height: 6em;">还没有任何提示信息</p>
                                            <span class="pull-right"><small>--<code><?=Yii::$app->name ?></code></small></span>
                                        <?php else: ?>
                                            <p style="text-indent: 2em;height: 6em;"><?=$tips->msg ?></p>
                                            <span class="pull-right"><small>--<code><?=Yii::$app->user->identity->username ?></code></small></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="panel-footer">
                                        <small><?=\yii\helpers\Html::a('刷新', ['/site/index']) ?>页面随机获取小提示</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <?= \kartik\icons\Icon::show('pencil') ?>今日签到
                                    </div>
                                    <div class="panel-body">
                                        <?php if ($signinForm->todaySignin->isNewRecord): ?>
                                            <?php $form = \yii\widgets\ActiveForm::begin(); ?>
                                            <?= $form->field($signinForm, 'message')->textarea(['rows' => 2, 'placeholder' => '签到信息', 'options' => []])->label(false) ?>
                                            <?= \yii\helpers\Html::submitButton("签到", ['class' => "btn btn-primary btn-block"]) ?>
                                            <?php \yii\widgets\ActiveForm::end(); ?>
                                        <?php else: ?>
                                            <p style="text-indent: 2em;height: 6em;"><?=$signinForm->todaySignin->message ?></p>
                                            <span class="pull-right"><small>你已经连续签到了<code><?=$signinForm->todaySignin->c_days ?></code>天</small></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="panel-footer">
                                        <?= \yii\helpers\Html::a("查看更多签到信息", ['#'], ['class' => "btn btn-xs"]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group">
                            <?php
                            $user_alert = new \common\models\UserAlert();
                            $user_alerts = $user_alert::find()->where(['to_user'=>Yii::$app->user->id, 'status'=>$user_alert::STATUS_UNREAD])->limit(10)->all();
                            ?>
                            <?php foreach($user_alerts as $k => $v): ?>
                                <a href="<?=$v->urls['view'] ?>" class="list-group-item">
                                    <i class="fa fa-bell fa-fw"></i> <?=$v->title ?>
                                        <span class="pull-right text-muted small"><em><?=date("Y-m-d H:i:s", $v->created_at) ?></em>
                                    </span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <!-- /.list-group -->
                        <a href="<?=$user_alert->urls['list'] ?>" class="btn btn-default btn-block">查看所有提醒</a>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?= \kartik\icons\Icon::show('tag') ?>热门标签
                        <span class="pull-right">
                            <small><?= \yii\helpers\Html::a('更多 ' . \kartik\icons\Icon::show('arrow-circle-right'), ['/tag']) ?></small>
                        </span>
                    </div>
                    <div class="panel-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae
                            ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                    </div>
                    <div class="panel-footer">
                        Panel Footer
                    </div>
                </div>
            </div>
            <div class="col-lg-12 hidden">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?= \kartik\icons\Icon::show('tag') ?>常见问题
                        <span class="pull-right">
                            <small><?= \yii\helpers\Html::a('更多 ' . \kartik\icons\Icon::show('arrow-circle-right'), ['/tag']) ?></small>
                        </span>
                    </div>
                    <div class="panel-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae
                            ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                    </div>
                    <div class="panel-footer">
                        Panel Footer
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
