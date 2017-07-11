<?php
$this->title = '所有标签';
$this->params['breadcrumbs'][] = $this->title;
$tags = \common\models\Tag::find()->all();
?>
<div class="tag-default-index">
    <div class="row">
        <div class="col-sm-12">
            <?php foreach($tags as $k => $v): ?>
                <?=\yii\helpers\Html::a($v->name, $v->urls['search_items_arr'], ['class'=>"btn btn-default btn-xs"]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
