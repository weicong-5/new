<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/8/8
 * Time: 9:33
 * 基础控制器
 */

namespace frontend\controllers\base;

use backend\models\LoginForm;
use common\models\User;
use yii\helpers\Url;
use yii\web\Controller;

class BaseController extends Controller{

    protected $auth_cookie_name = 'fake_login_in';
    protected $current_user = null;//当前登录人信息

    protected $allowAllAction = [
        'post/index',
        'post/create',
        'site/login',
        'user/index',

    ];

    public function beforeAction($action)
    {
//        $this->checkLoginStatus();
//        $reback_url = Url::toRoute(array_merge(['/site/login']));
//////        $model = new LoginForm();
//        $login_status = $this->checkLoginStatus();
//////        echo $action->uniqueId;
//        if(!$login_status && !in_array($action->uniqueId,$this->allowAllAction)){
//            $this->redirect($reback_url);
//        }else{
////            return true;
//            return parent::beforeAction($action);
//        }

//        if(!$login_status && !in_array($action->uniqueId,$this->allowAllAction)){
//            if(\Yii::$app->request->isAjax){
//                $this->renderJSON([],'未登录，请登录',-302);
//            }else{
//                $this->render('login',[
//                    'model' => $model,
//                ]);
//            }
//            return false;
//        }
//        return true;
        return parent::beforeAction($action);
    }

    /**
     * @param $key
     * @param string $default
     * @return array|mixed  统一获取psst参数的方法
     */
    public function post($key,$default = ''){
        return \Yii::$app->request->post($key,$default);
    }

    /**
     * @param $key
     * @param string $default
     * @return array|mixed  统一获取get参数的方法
     */
    public function get($key,$default = ''){
        return \Yii::$app->request->get($key,$default);
    }

    /**
     * @param array $data 数据区
     * @param string $msg 提示消息
     * @param int $code 状态码 200 表示成功
     * @throws \yii\base\ExitException  封装json返回值，主要用于ajax和后端交互 返回格式
     */
    public function renderJSON($data=[],$msg='ok',$code=200){
        header('Content-type:application/json');
        echo json_encode([
            'code' => $code,
            'msg' => $msg,
            'data' =>  $data,
            'req_id' => uniqid(),
        ]);
        return \Yii::$app->end();//终止请求直接返回
    }

    /**
     * @param $user_info 设置登录态cookie
     */
    public function createLoginStatus($user_info){
        $auth_token =$this->createAuthToken($user_info['id'],$user_info['username'],$user_info['email']);
        $cookies = \Yii::$app->response->cookies;
        $cookies->add(new \yii\web\Cookie([
            'name' => $this->auth_cookie_name,
            'value' => $auth_token."#".$user_info['id'],
        ]));
    }

    /**
     * @param $uid
     * @param $name
     * @param $email
     * @return string   用户相关信息生成加密验证码 函数
     */
    public function createAuthToken($uid,$name,$email){
        return md5($uid.$name.$email);
    }

    /**
     * @return bool 检查登录状态
     */
    protected function checkLoginStatus(){
        $request = \Yii::$app->request;
        $cookies = $request->cookies;
        $auth_cookie = $cookies->get($this->auth_cookie_name);

        if(!$auth_cookie){
            return false;
        }

        list($auth_token,$uid) = explode('#',$auth_cookie);

        if(!$auth_token || !$uid){
            return false;
        }

        if($uid && preg_match('/^\d+$/',$uid)){
            //校队用户
            $user_info = User::findOne(['id'=>$uid]);
            if(!$user_info){
                return false;
            }
            //校对验证码
            if($auth_token != $this->createAuthToken($user_info['id'],$user_info['username'],$user_info['email'])){
                return false;
            }
            $this->current_user = $user_info;
            $view = \Yii::$app->view;
            $view->params['current_user'] = $user_info;
            return true;

        }
    }
}