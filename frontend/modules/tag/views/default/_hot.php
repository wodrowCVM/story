<?php
$tags = \common\models\Tag::find()->orderBy(['created_at'=>SORT_DESC])->limit(10)->all();
?>

<div class="panel panel-default">
    <div class="panel-heading">
        最新标签
    </div>
    <div class="panel-body">
        <?php foreach($tags as $k => $v): ?>
            <?=\yii\helpers\Html::a($v->name, $v->urls['search_items_arr'], ['class'=>"btn btn-default btn-xs"]) ?>
        <?php endforeach; ?>
    </div>
</div>
