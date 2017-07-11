<?php

namespace frontend\modules\tag\controllers;

use common\models\ItemTag;
use common\models\Tag;
use yii\data\Pagination;
use yii\web\Controller;

/**
 * Default controller for the `tag` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSearch($id)
    {
        $tag = Tag::findOne($id);
        $query = ItemTag::find()->orderBy(['created_at'=>SORT_DESC])->where(['tag_id'=>$tag->id]);
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 10,
        ]);
        $item_tags = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('search', [
            'tag' => $tag,
            'item_tags' => $item_tags,
            'pages' => $pages,
        ]);
    }
}
