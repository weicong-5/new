<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/8/17
 * Time: 10:23
 */

namespace backend\modules\roles\controllers;

use backend\Modules\roles\controllers\Base\BaseController;
use backend\Modules\roles\models\RoleForm;
use backend\Modules\roles\models\Roles;
use backend\Modules\roles\models\StudentForm;
use common\models\RelationUserStatus;
use common\models\School;
use common\models\Student;
use yii\filters\VerbFilter;


/**
 * Default controller for the `role` module
 */
class StatusController extends BaseController
{



    public function actionIndex()
    {
        return $this->render('index');
    }

    //点击创建身份
    public function actionSelect()
    {
        $roles = Roles::getAllRoles();
        $model = new Roles();
        return $this->render('select', ['model' => $model, 'roles' => $roles]);
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
    public function actionCreate()
    {
        $rid = \Yii::$app->request->get('rid', 0);
        $uid = \Yii::$app->request->get('uid', 0);

        //获取所有学校
        $schools = School::getAllSchool();
        //获取所有年级


        switch ($rid) {
            case 1:
//                $model = new StudentForm();
//                return $this->render('CreateStudent',['model'=>$model,'rid'=>$rid,'uid'=>$uid,'schools'=>$schools]);
//                return $this->redirect(['index','rid'=>$rid,'uid'=>$uid]);
                return $this->redirect(['create-student', 'rid' => $rid, 'uid' => $uid]);//注意 驼峰式命名 大写转小写 中间-连接
//                return $this->render('createStudent',['model'=>$model,'rid'=>$rid,'uid'=>$uid,'schools'=>$schools]);
                break;
            case 2:
                return $this->render('createTeacherStaff', ['uid' => $uid]);
                break;
            default:
                return null;
                break;
        }
    }


    //创建学生身份
//    public function actionCreateStudent(){
//        $uid = \Yii::$app->request->get('uid',0);
//        $rid = \Yii::$app->request->get('rid',0);
//
//        $model = new StudentForm();
//        //如果是提交操作
//        if($model->load(\Yii::$app->request->post()) && $model->validate()){
//            if(!$model->create()){
//                \Yii::$app->session->setFlash('warning',$model->_lastError);
////                $this->renderJSON([],'学生身份创建失败',-1);
////                return $this->redirect(['role/role-users/view','id'=>$uid]);
//            }else{
//                $relation = new RelationUserStatus();
//                $relation['user_id'] = $uid;
//                $relation['status_id'] = $model->id;
//                $res = $relation->save();
//                if(!$res){
//                    \Yii::$app->session->setFlash('warning','用户身份关系关联失败');
////                    $this->renderJSON([],'用户身份关系关联失败',-1);
////                    return $this->redirect(['role/role-users/view','id'=>$uid]);
//                }else{
//                    \Yii::$app->session->setFlash('success','成功');
////                    $this->renderJSON([],'操作成功',200);
////                    return $this->redirect(['role/role-users/view','id'=>$uid]);
//                    return $this->redirect(['role/role-users/view','id'=>$uid]);
//                }
//            }
//        }else{
//            return $this->render('createStudent',['model'=>$model,'rid'=>$rid,'uid'=>$uid]);
//        }
//    }

    public function actionCreateStudent()
    {
//        echo '111';
        $uid = \Yii::$app->request->get('uid', 0);
        $rid = \Yii::$app->request->get('rid', 0);
        $schools = School::getAllSchool();
        $model = new StudentForm();
        $model->setScenario(StudentForm::SCENARIOS_CREATE);
        //如果是提交操作
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            if (!$model->create($uid)) {
                \Yii::$app->session->setFlash('warning', $model->_lastError);
                $roles = Roles::getAllRoles();
                $model = new Roles();
                return $this->render('select',['roles'=>$roles,'model'=>$model]);
            } else {
                return $this->redirect(['/role/role-users/view', 'id' => $uid]);
            }
        }
        else{
            return $this->render('createStudent', ['model' => $model, 'rid' => $rid, 'uid' => $uid,'schools'=>$schools]);
        }

//        return $this->render('createStudent', ['model' => $model, 'rid' => $rid, 'uid' => $uid,'schools'=>$schools]);
//        return $this->redirect(['role-users/view','id'=>$uid]);
    }
}