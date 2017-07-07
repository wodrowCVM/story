<?php
/**
 * @var \yii\web\View $this
 * @var \common\models\Essay $essay
 */
$this->title = "随笔--".$essay->title;
$this->params['breadcrumbs'][] = \yii\helpers\Html::a('随笔列表', $essay->urls['list_arr'], []);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="essay-default-view">
    <div class="row">
        <div class="col-lg-9 col-md-8 col-sm-7">
            <div class="row">
                <div class="col-sm-12">
                    <?=$essay->content ?>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-5">
            <?=$this->render('_state') ?>
        </div>
    </div>
</div>
