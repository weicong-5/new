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

    /**
     * 选择角色
     * @return string
     */
    public function actionSelect()
    {
        $roles = Roles::getAllRoles();
        $model = new Roles();
        return $this->render('select', ['model' => $model, 'roles' => $roles]);
    }

    /**
     * 选择创建的角色
     * @return null|string|\yii\web\Response
     */
    public function actionCreate()
    {
        $rid = \Yii::$app->request->get('rid', 0);
        $uid = \Yii::$app->request->get('uid', 0);

        switch ($rid) {
            case 1:
                return $this->redirect(['create-student', 'rid' => $rid, 'uid' => $uid]);//注意 驼峰式命名 大写转小写 中间-连接
                break;
            case 2:
                return $this->redirect('create-teacher-staff', ['rid'=>$rid,'uid' => $uid]);
                break;
            default:
                return null;
                break;
        }
    }


    /**
     * 创建学生身份
     * @return string|\yii\web\Response
     */
    public function actionCreateStudent()
    {
        $uid = \Yii::$app->request->get('uid', 0);
        $rid = \Yii::$app->request->get('rid', 0);
        $schools = School::getAllSchool();
        $model = new StudentForm();
        $model->setScenario(StudentForm::SCENARIOS_CREATE);
        //如果是提交操作
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            if (!$model->create($uid,$rid)) {
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
    }

    //创建教师职工身份
    public function actionCreateTeacherStaff(){
        $uid = \Yii::$app->request->get('uid',0);
        $rid = \Yii::$app->request->get('rid',0);
        $schools = School::getAllSchool();
        $model = new TeacherForm();
    }
}