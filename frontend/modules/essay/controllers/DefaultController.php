<?php

namespace frontend\modules\essay\controllers;

use common\models\Essay;
use yii\data\Pagination;
use yii\web\Controller;

/**
 * Default controller for the `essay` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $query = Essay::find()->orderBy(['created_at'=>SORT_DESC]);
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 10,
        ]);
        $essays = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'essays' => $essays,
            'pages' => $pages,
        ]);
    }

    public function actionView($id)
    {
        $essay = $this->findEssay($id);
        return $this->render('view', [
            'essay' => $essay,
        ]);
    }

    public function findEssay($id)
    {
        $essay = Essay::findOne(['id'=>$id, 'status'=>Essay::STATUS_ACTIVE]);
        return $essay;
    }
}
