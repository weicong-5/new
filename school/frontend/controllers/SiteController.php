<?php
namespace frontend\controllers;

use common\models\Student;
use common\models\User;
use kartik\helpers\Enum;
use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\jui\SliderInput;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\ykocomposer\controller\CoreController;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends CoreController
{
    public $layout = 'site_main';

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
                    'logout' => ['post','get'],
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
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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
     * 身份选择
     * @return array
     */
    public function actionChoose(){
        if(Yii::$app->request->isAjax){
            $data = Yii::$app->request->post();
            $status = $data['status'];
            $user_id = $data['user_id'];//用户id
            $name = $data['name'];//角色名称（学生名称 教师名称..）
            $selectIndex = $data['selectIndex'];
            $session = Yii::$app->session;
            if(!$session->isActive){
                $session->open();
            }
            if($status == '学生'){
                $student_info = Student::find()->where(['user_id'=>$user_id,'student_name'=>$name])->asArray()->one();
                $session->set('student_id',$student_info['id']);
            }


            $session->set('status',$status);
            $session->set('user_id',$user_id);
            $session->set('name',$name);
            $session->set('selectIndex',$selectIndex);
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return[
                'status'=>$status,
                'user_id'=>$user_id,
                'name'=>$name,
            ];
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
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
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
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
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        $sex_list = SignupForm::getSexList();
        $political_list = SignupForm::getPoliticalList();
        return $this->render('signup', [
            'model' => $model,
            'sex_list' => $sex_list,
            'political_list' => $political_list,
        ]);
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
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
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
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * 前往用户资料 个人中心
     * @return string
     */
    public function actionPersonal(){
        $user = User::findByUserName(yii::$app->user->identity->username);
        $profile = $user->profile;
        return $this->render('personal',[
            'user' => $user,
            'profile'=>$profile,
        ]);
    }

    /**
     * 生活圈 美食专栏
     * @return string
     */
    public function actionEat(){
        return $this->render('livingArea/eat');
    }

    /**
     * 生活圈 喝 专栏
     * @return string
     */
    public function actionDrink(){
        return $this->render('livingArea/drink');
    }

    /**
     * 生活圈 游玩专栏
     * @return string
     */
    public function actionPlay(){
        return $this->render('livingArea/play');
    }

    /**
     * 生活圈 购物专栏
     * @return string
     */
    public function actionShopping(){
        return $this->render('livingArea/shopping');
    }
}
