<?php

/* @var $this yii\web\View */

$this->title = '首页';
?>
<div class="site-index">
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
                    <a href="#">
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
                                <div class="huge">12</div>
                                <div>随笔数</div>
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
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <?= \kartik\icons\Icon::show('book', ['class' => 'fa-5x']) ?>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">124</div>
                                <div>小说数</div>
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
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <?= \kartik\icons\Icon::show('tags', ['class' => 'fa-5x']) ?>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">13</div>
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
                        Pie Chart Example
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="flot-chart">

                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Pie Chart Example
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
    </div>
</div>
