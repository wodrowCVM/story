<?php
/**
 * @var \yii\web\View $this
 */
$this->beginContent('@frontend/views/layouts/base.php');
?>

<div class="container">
    <?= \yii\widgets\Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        'encodeLabels' => false,
    ]) ?>
    <?= \common\widgets\Alert::widget() ?>
    <?= $content ?>
</div>
<?php
$this->endContent();
?>