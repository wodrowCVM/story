<?php
use kartik\detail\DetailView;
/**
 * @var \yii\web\View $this
 * @var \common\models\Essay $essay
 */
$this->title = "获取随笔--".$essay->title;
$this->params['breadcrumbs'][] = ['label' => '随笔列表', 'url' => $essay->urls['list_arr']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-essay-buy">
    <div class="row">
        <div class="col-sm-12">
            <?php echo DetailView::widget([
                'model'=>$essay,
                'condensed'=>true,
                'hover'=>true,
                'mode'=>DetailView::MODE_VIEW,
                'panel'=>[
                    'heading'=>$this->title,
                    'type'=>DetailView::TYPE_DEFAULT,
                    'headingOptions' => [
                        'template' => '{title}',
                    ],
                ],
                'attributes'=>[
                    [
                        'group'=>true,
                        'label'=>'随笔信息',
                        'rowOptions'=>['class'=>'info']
                    ],
                    'id',
                    'title',
                    'desc',
                    [
                        'label' => '作者',
                        'value' => $essay->createdBy->urls['info_show_username'],
                        'format' => 'raw',
                    ],
                    'created_at:datetime',
                    'updated_at:datetime',
                    [
                        'group'=>true,
                        'label'=>'获取条件',
                        'rowOptions'=>['class'=>'info']
                    ],
                    [
                        'columns' => [
                            [
                                'label' => '你的经验值',
                                'value'=>Yii::$app->user->identity->xp,
                                'format'=>'raw',
                                'displayOnly'=>true,
                            ],
                            [
                                'label' => '剩余金币',
                                'value'=>Yii::$app->user->identity->money,
                                'format'=>'raw',
                                'displayOnly'=>true,
                            ],
                            [
                                'label' => '剩余积分',
                                'value'=>Yii::$app->user->identity->integral,
                                'format'=>'raw',
                                'displayOnly'=>true,
                            ],
                        ],
                    ],
                    [
                        'columns' => [
                            [
                                'attribute'=>'need_xp',
                                'format'=>'raw',
                                'displayOnly'=>true,
                            ],
                            [
                                'attribute'=>'need_money',
                                'format'=>'raw',
                                'displayOnly'=>true
                            ],
                            [
                                'attribute'=>'need_integral',
                                'format'=>'raw',
                                'displayOnly'=>true
                            ],
                        ],
                    ],
                ]
            ]); ?>
        </div>
    </div>
</div>
