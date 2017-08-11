<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/8/10
 * Time: 15:27
 */
namespace frontend\controllers;



use frontend\models\LoginForm;
use yii\helpers\Url;
use common\models\User;
use frontend\controllers\base\BaseController;
use Yii;

class UserController extends BaseController{

    //伪登录动作
    public function actionLogin(){
//        echo 'aaaaaaaaaaaaaa';
        $uid = $this->get('uid',0);
        $reback_url = Url::toRoute(array_merge(['/site/login']));
        $root_url = Url::toRoute(array_merge(['/']));
//        echo url::home();
//        $this->redirect('/site/login');
//        $reback_url = UrlService::buildUrl('/');
//        echo $reback_url;

//        exit();

        if(!$uid){//uid无效
            $this->redirect($reback_url);
            return false;
        }

        $user_info = User::find()->where(['id'=>$uid])->one();
//        echo '<br>用户信息';
//        print_r($user_info);
//        exit();
        if(!$user_info){
            $this->redirect($reback_url);
            return false;
        }
//        exit();
        //cookie保存用户的登录状态 所以cookie要加密
//        $user_auth_token  = md5($user_info['id'].$user_info['name'].$user_info['email'].$user_info['created_at']);
//
//        $cookie_target = \Yii::$app->response->cookies;
//        $cookie_target->add(new \yii\web\Cookie([
//                'name' => 'fake_login_in',
//                'value' => $user_auth_token,
//            ])
//        );
//        $this->createLoginStatus($user_info);
//        return $this->render('index',['user_info'=>$user_info]);
        $model = new LoginForm();
        $model->username = $user_info['username'];
        $model->password = $user_info['password_hash'];//这里显示的是加密的密码 所以失败
        $loginView = $reback_url = Url::toRoute(array_merge(['/site/login']));
        if($model->login()){
            return $this->goBack();
        }else{
            return $this->render($loginView,[
               'model'=>$model,
            ]);
        }
    }

}