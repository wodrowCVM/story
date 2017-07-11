<?php
/**
 * @var \yii\web\View $this
 * @var \common\models\Essay $essay
 * @var \common\models\EssayReply[] $essay_replys
 * @var \yii\data\Pagination $pages
 * @var \frontend\modules\essay\EssayReplyForm $essay_reply_form
 */
$this->title = "随笔--" . $essay->title;
$this->params['breadcrumbs'][] = \yii\helpers\Html::a('随笔列表', $essay->urls['list_arr'], []);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="essay-default-view">
    <div class="row">
        <div class="col-lg-9 col-md-8 col-sm-7">
            <div class="row">
                <div class="col-sm-12">
                    <?= $essay->content ?>
                </div>
                <div style="margin-top: 4em;"></div>
                <div class="col-sm-12">
                    <?php if ($essay_replys): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                回复列表
                            </div>
                            <div class="panel-body">
                                <div class="items">
                                    <div class="row">
                                        <?php foreach ($essay_replys as $k => $v): ?>
                                            <div class="col-sm-12 item-list">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="item-body">
                                                            <p><?= $v->content ?></p>
                                                        </div>
                                                        <div class="item-foot">
                                                            <small>
                                                                <?= \kartik\icons\Icon::show('user') ?>
                                                                回复者: <?= $v->createdBy->urls['info_show_username'] ?>
                                                                <span style="margin-left: 2em;"></span>
                                                                <?= \kartik\icons\Icon::show('calendar') ?>
                                                                回复日期: <?= date("Y-m-d", $v->created_at) ?>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <?php if ($pages->totalCount > $pages->pageSize): ?>
                                <div class="panel-footer">
                                    <div class="pages">
                                        <?= \yii\widgets\LinkPager::widget([
                                            'pagination' => $pages,
                                            'firstPageLabel' => '首页',
                                            'lastPageLabel' => '尾页',
                                            'prevPageLabel' => '上一页',
                                            'nextPageLabel' => '下一页',
                                            'maxButtonCount' => 10, //控制每页显示的页数
                                        ]) ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            回复
                        </div>
                        <div class="panel-body">
                            <?php $form = \kartik\widgets\ActiveForm::begin(); ?>
                            <?= $form->field($essay_reply_form, 'content')->textarea() ?>
                            <?= $form->field($essay_reply_form, 'code')->widget(\yii\captcha\Captcha::className(), [
                                'captchaAction' => '/site/captcha',
                            ]) ?>
                            <?= \kartik\helpers\Html::submitButton('提交', ['class' => "btn btn-primary"]) ?>
                            <?php \kartik\widgets\ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-5">
            <?= $this->render('_state') ?>
        </div>
    </div>
</div>
