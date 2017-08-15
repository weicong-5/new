<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ActivationForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\Finder;
use dektrium\user\models\Token;
use yii\web\NotFoundHttpException;

/**
 * RegistrationController is responsible for all registration process, which includes registration of a new account,
 * resending confirmation tokens, email confirmation and registration via social networks.
 *
 * @property \dektrium\user\Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class ActivationController extends Controller
{
    use AjaxValidationTrait;

    public $layout = '@backend/views/layouts/base';

    /** @var Finder */
    protected $finder;

    /**
     * @param string           $id
     * @param \yii\base\Module $module
     * @param Finder           $finder
     * @param array            $config
     */
    public function __construct($id, $module, Finder $finder, $config = [])
    {
        $this->finder = $finder;
        parent::__construct($id, $module, $config);
    }

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
        ];
    }

    /**
     * Displays the activation page.
     *
     * @return string|Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionIndex()
    {
        if (!Yii::$app->getModule('user')->enablePasswordRecovery) {
            throw new NotFoundHttpException();
        }

        if (!Yii::$app->user->isGuest) {
            $this->goHome();
        }

        /** @var ActivationForm $model */
        $model = Yii::createObject([
            'class' => ActivationForm::className(),
            'scenario' => 'index',
        ]);

        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->request->post())) {
            /** @var Token $token */
            $userId = $this->finder->findUser(['phone' => $model->phone])->one();

            $token = $this->finder->findToken(['user_id' => $userId['id'], 'code' => $model->code, 'type' => Token::TYPE_RECOVERY])->one();
            if ($token === null || $token->isExpired || $token->user === null) {
                Yii::$app->session->setFlash('danger', Yii::t('user', 'Recovery link is invalid or expired. Please try requesting a new one.'));
            }

            if ($model->resetPassword($token)) {
                Yii::$app->session->setFlash('danger', Yii::t('user', 'Recovery link is invalid or expired. Please try requesting a new one.'));
            }
        }
        if (\Yii::$app->request->isAjax) {
            return $this->renderAjax('index', [
                'model' => $model,
            ]);
        } else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }

        /*$this->performAjaxValidation($model);

        if ($model->load(Yii::$app->request->post()) && $model->resend()) {
            return $this->goBack();
        } else {
            if (\Yii::$app->request->isAjax) {
                return $this->renderAjax('index', [
                    'model' => $model,
                ]);
            } else {
                return $this->render('index', [
                    'model' => $model,
                ]);
            }
        }*/
    }

    /**
     * Determines whether there is a phone number.
     *
     * @return boolean
     */
    public function actionCheckMobileExists()
    {
        $mobile = Yii::$app->request->post('phone');
        $checkMobile = $this->finder->findUser(['phone' => $mobile])->one();
        if($checkMobile){
            if ($checkMobile['confirmed_at'] != null) {
                echo 'HasConfirmed';
            } else {
                echo 'Success';
            }
        }else{
            echo 'Failed';
        }
    }

    /**
     * Send verification code.
     *
     * @return boolean
     */
    public function actionSendLoginCode()
    {
        $model = Yii::createObject([
            'class'    => ActivationForm::className(),
            'scenario' => 'sendLoginCode',
        ]);
        //$this->performAjaxValidation($model);
        if ($model->load(Yii::$app->request->post()) && $model->resend()) {
            echo 'Success';
        } else {
            echo 'Failed';
        }
    }

}
