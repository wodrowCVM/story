<?php
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\user\models\EssaySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = '我的提醒';
$this->params['breadcrumbs'][] = ['label' => '个人中心', 'url' => ['/user']];
$this->params['breadcrumbs'][] = $this->title;