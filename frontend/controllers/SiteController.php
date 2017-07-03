<?php
namespace frontend\controllers;

use common\models\User;
use frontend\models\ActiveForEmailForm;
use Yii;
use yii\base\ErrorException;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'minLength' => 4,
                'maxLength' => 4,
                'fontFile' => '@data/fonts/ztgjkt.ttf',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                Yii::$app->session->setFlash('success', "恭喜你[".$user->username."]已经注册成功，请进入邮箱激活后登录");
                return $this->redirect(['login']);
            }else{
                Yii::$app->session->getFlash('error');
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionActiveForEmail()
    {
        $model = new ActiveForEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = User::findOne(['email'=>$model->email]);
            if (!$user){
                throw new ErrorException("没有找到用户", 1002);
            }
            if ($user->status == $user::STATUS_ACTIVE){
                Yii::$app->session->setFlash('success', "已经激活的用户");
                return $this->redirect(['login']);
            }
            \Yii::$app->cache->set($user->username."_signup_active_key", \Yii::$app->security->generateRandomKey(), 3600);
            $is_send = \Yii::$app->mailer
                ->compose(['html'=>'signup'], ['url'=>\yii\helpers\Url::toRoute(['site/set-active', 'username'=>$user->username, 'code'=>\Yii::$app->cache->get($user->username."_signup_active_key")], true)])
                ->setFrom(\Config::$adminEmail)
                ->setTo($user->email)
                ->setSubject("激活用户")
                ->send();
            if ($is_send){
                if ($user->save()){
                    \Yii::$app->session->setFlash('success', '激活链接发送成功，请进入邮箱激活。');
                }else{
                    \Yii::$app->session->setFlash('error', '用户激活失败。');
                }
            }else{
                \Yii::$app->session->setFlash('error', '邮箱发送邮件失败，请检查邮箱是否有效或更换邮箱。');
            }
            return $this->redirect(['login']);
        }
        return $this->render('active-for-email', [
            'model' => $model,
        ]);
    }

    /**
     * set active
     * @param $username
     * @param $code
     * @return \yii\web\Response
     * @throws ErrorException
     */
    public function actionSetActive($username, $code)
    {
        $user = User::findOne(['username'=>$username]);
        if (!$user){
            throw new ErrorException("没有找到用户", 1002);
        }
        if ($user->status == $user::STATUS_ACTIVE){
            Yii::$app->session->setFlash('success', "已经激活的用户");
            return $this->redirect(['login']);
        }
        if (Yii::$app->cache->get($user->username."_signup_active_key") == $code){
            $user->status = $user::STATUS_ACTIVE;
            if ($user->save()){
                Yii::$app->session->setFlash('success', "恭喜你[".$user->username."]已经激活成功");
                Yii::$app->cache->delete($user->username."_signup_active_key");
                if (Yii::$app->user->login($user)){
                    return $this->redirect(['index']);
                }
            }
        }else{
            Yii::$app->session->setFlash('error', "激活失败,你的激活码可能已经过期");
            return $this->redirect(['login']);
        }
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', '发送成功，检查你的邮箱重置密码。');
//                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', '对不起，没有找到邮箱，发送失败。请检查你的邮箱！');
            }
        }
        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', '新的密码已经保存成功.');
            return $this->redirect(['login']);
        }
        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
