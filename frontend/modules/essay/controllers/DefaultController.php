<?php

namespace frontend\modules\essay\controllers;

use common\models\Essay;
use common\models\EssayReply;
use common\models\UserEssay;
use frontend\modules\essay\EssayReplyForm;
use yii\base\ErrorException;
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
        if (!$essay){
            \Yii::$app->session->setFlash("error", "没有找到随笔！");
//            throw new ErrorException("没有找到随笔！", 1013);
            return $this->goBack();
        }
        if (\Yii::$app->user->id == $essay->created_by){}else{
            if (!\Yii::$app->user->isAdmin&&!UserEssay::findOne(['essay_id'=>$essay->id, 'created_by'=>\Yii::$app->user->id])){
                \Yii::$app->session->setFlash("error", "请先获取随笔！");
                return $this->redirect($essay->urls['buy_arr']);
//            throw new ErrorException("请先获取随笔！", 1014);
            }
        }
        $query = EssayReply::find()->orderBy(['created_at'=>SORT_DESC])->where(['essay_id'=>$essay->id]);
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 10,
        ]);
        $essay_replys = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $essay_reply_form = new EssayReplyForm();
        $essay_reply_form->essay_id = $essay->id;
        if ($essay_reply_form->load(\Yii::$app->request->post())&&$essay_reply_form->validate()){
            $trans = \Yii::$app->db->beginTransaction();
            try{
                $x = $essay_reply_form->save();
                if ($x){
                    $trans->commit();
                    return $this->redirect($essay->urls['view_arr']);
                }else{}
            }catch (ErrorException $e){
                $trans->rollBack();
                throw $e;
            }
        }
        return $this->render('view', [
            'essay' => $essay,
            'essay_replys' => $essay_replys,
            'pages' => $pages,
            'essay_reply_form' => $essay_reply_form,
        ]);
    }

    public function findEssay($id)
    {
        $essay = Essay::findOne(['id'=>$id, 'status'=>Essay::STATUS_ACTIVE]);
        return $essay;
    }
}
