<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/8/17
 * Time: 10:23
 */

namespace backend\modules\roles\controllers;

use backend\Modules\roles\models\RoleForm;
use backend\Modules\roles\models\Roles;
use common\models\Student;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Default controller for the `role` module
 */
class StatusController extends Controller
{
//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//               'class' => VerbFilter::className(),
//                'actions' => [
//                    '*' => ['post','get'],
//                ]
//            ]
//        ];
//    }


    public function actionIndex()
    {

    }
    //点击创建身份
    public function actionSelect()
    {
        $roles = Roles::getAllRoles();
        $model = new Roles();
        return $this->render('select',['model'=>$model,'roles'=>$roles]);
    }

    //创建身份之前确定角色
//    public function actionChoose(){
//        $model = new RoleForm();
//        if($model->load(\Yii::$app->request->post()) && $model->validate()){
//            return $this->redirect(['status/create','rid'=>$model->id]);
//        }else{
//            return $this->redirect(['status/create','model'=>$model]);
//        }
//    }
    //根据rid不同创建不同的身份
    public function actionCreate(){
        $rid = \Yii::$app->request->get('rid');
        $uid = \Yii::$app->request->get('uid');
        switch($rid){
            case 1:
                $model = new Student();
                return $this->render('createStudent',['model'=>$model,'uid'=>$uid]);
                break;
            case 2:
                return $this->render('createTeacherStaff',['uid'=>$uid]);
                break;
            default:
                return null;
                break;
        }
    }
}