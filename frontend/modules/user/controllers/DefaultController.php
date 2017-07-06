<?php

namespace frontend\modules\user\controllers;

use frontend\modules\user\models\ResetPasswordForm;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $user = \Yii::$app->user->identity;
        if ($user->load(\Yii::$app->request->post())&&$user->validate()){
            $user->save();
            \Yii::$app->session->setFlash('success', '保存成功!');
        }
        return $this->render('index', [
            'user' => $user,
        ]);
    }

    public function actionResetPassword()
    {
        $resetPasswordForm = new ResetPasswordForm();
        if ($resetPasswordForm->load(\Yii::$app->request->post())&&$resetPasswordForm->validate()){
            if ($resetPasswordForm->resetPassword()){
                \Yii::$app->session->setFlash('success', '重置成功!');
            }else{
                \Yii::$app->session->setFlash('success', '重置失败!');
            }
        }
        return $this->render('reset-password', [
            'resetPasswordForm' => $resetPasswordForm,
        ]);
    }

    public function actionSet()
    {
        return $this->render('set');
    }
}
