<?php

namespace frontend\modules\user\controllers;

use common\components\tools\Tools;
use common\models\UserEssay;
use Yii;
use frontend\modules\user\models\Essay;
use frontend\modules\user\models\EssaySearch;
use yii\base\ErrorException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EssayController implements the CRUD actions for Essay model.
 */
class EssayController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Essay models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EssaySearch();
        $searchModel->created_by = Yii::$app->user->id;
        $params = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search($params);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Essay model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerBindEssayTag = new \yii\data\ArrayDataProvider([
            'allModels' => $model->bindEssayTags,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerBindEssayTag' => $providerBindEssayTag,
        ]);
    }

    /**
     * Creates a new Essay model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Essay();
        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Essay model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Essay model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }

    
    /**
     * Finds the Essay model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Essay the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Essay::findOne($id)) !== null) {
            if ($model->canAdmin){
                return $model;
            }else{
                throw new NotFoundHttpException(Yii::t('app', '你无权处理。'));
            }
        } else {
            throw new NotFoundHttpException(Yii::t('app', '没有找到随笔。'));
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for BindEssayTag
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddBindEssayTag()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('BindEssayTag');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formBindEssayTag', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    public function actionGetBuy()
    {
        return $this->render('get-buy');
    }

    public function actionBuy($id)
    {
        $essay = \common\models\Essay::findOne(['id'=>$id, 'status'=>Essay::STATUS_ACTIVE]);
        $user_essay = UserEssay::findOne(['essay_id'=>$essay->id, 'created_by' => Yii::$app->user->id]);
        if ($user_essay){
            Yii::$app->session->setFlash('info', "你已经拥有此随笔!");
            return $this->redirect($essay->urls['view_arr']);
        }else{
            $user_essay = new UserEssay();
            $user_essay->essay_id = $essay->id;
            $user_essay->status = UserEssay::STATUS_ACTIVE;
            $user_essay->buy_log = json_encode([
                'essay'=>$essay->toArray()
            ]);
        }
        if ($user_essay->load(Yii::$app->request->post())&&$user_essay->validate()){
//            Yii::$app->session->setFlash('success', "获取成功!");
            $trans = Yii::$app->db->beginTransaction();
            try{
                $x = $user_essay->save();
                $trans->commit();
            }catch (ErrorException $e){
                $trans->rollBack();
                throw $e;
            }
            if ($x){
                return $this->redirect($essay->urls['view_arr']);
            }
        }else{
//            Yii::$app->session->setFlash('error', "获取失败!");
//            return $this->goBack();
        }
        return $this->render('buy', [
            'essay' => $essay,
            'user_essay' => $user_essay,
        ]);
    }
}
