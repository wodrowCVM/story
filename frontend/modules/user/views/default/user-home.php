<?php
/**
 * @var \yii\web\View $this
 * @var \common\models\User $user
 */
$this->title = "个人主页";
$this->params['breadcrumbs'][] = $user->urls['list_show_label'];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo $user->username ?>
