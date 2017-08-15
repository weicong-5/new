<?php
/**
 * @Copyright Copyright (c) 2016 @SecurityController.php By Kami
 * @License http://www.yuzhai.tv/
 */

namespace backend\controllers;

use Yii;
use dektrium\user\models\LoginForm;
use dektrium\user\controllers\SecurityController as BaseSecurityController;
class SecurityController extends BaseSecurityController
{
    /**
     * Displays the login page.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        $this->layout = '@backend/views/layouts/base';
        if (!Yii::$app->user->isGuest) {
            $this->goHome();
        }

        /** @var LoginForm $model */
        $model = Yii::createObject(LoginForm::className());

        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
            return $this->goBack();
        }
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('@backend/views/security/login',[
                'model' => $model,
                'module' => $this->module,
            ]);
        } else {
            return $this->render('@backend/views/security/login', [
                'model' => $model,
                'module' => $this->module,
            ]);
        }
    }
}