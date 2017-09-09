<?php

namespace backend\controllers;

use common\models\Grade;
use common\models\School;
use common\models\Status;
use Yii;
use common\models\TeacherStaff;
use common\models\TeacherStaffSearch;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TeacherStaffController implements the CRUD actions for TeacherStaff model.
 */
class TeacherStaffController extends Controller
{
    //定义事件
    const EVENT_AFTER_CREATE = 'eventAfterCreate';//创建之后的事件
    const EVENT_AFTER_DELETE = 'eventAfterDelete';//删除之后的事件
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TeacherStaff models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeacherStaffSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TeacherStaff model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TeacherStaff model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($user_id,$status)
    {
        $model = new TeacherStaff();
        $model->setAttribute('user_id',$user_id);
        $selects = array('0'=>'请选择');
        $staff_type = array_merge($selects,TeacherStaff::getAllStaffType());
        $political_status = array_merge($selects,TeacherStaff::getAllPoliticalStatus());
        $schools = array_merge($selects,School::getAllSchool());
        $grades = array_merge($selects,Grade::getAllGrades());

//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('create', [
//                'model' => $model,
//                'staff_type' => $staff_type,
//                'political_status' => $political_status,
//                'schools' => $schools,
//                'grades' => $grades,
//            ]);
//        }
        if($model->load(Yii::$app->request->post())){
            $teach_class = $model->getAttribute('teach_class');
            if(!empty($teach_class)){
                $class_array = explode(" ",trim($teach_class));
                $model->setAttribute('teach_class',serialize($class_array));
            }
            if($model->validate() && $model->save()){
                $data = $model->getAttributes();
                $data['status'] = $status;
                $this->_eventAfterCreate($data);
                return $this->redirect(['users/view','id'=>$model->user_id]);
            }else{
                Yii::$app->getSession()->setFlash('error','该角色已经存在,角色创建失败');//因为save失败  这里应该用属性组合唯一规则验证 多个属性决定唯一性才行
                return $this->render('create',[
                    'model' => $model,
                    'staff_type' => $staff_type,
                    'political_status' => $political_status,
                    'schools' => $schools,
                    'grades' => $grades,
                ]);
            }
        }else{
            return $this->render('create',[
                'model' => $model,
                'staff_type' => $staff_type,
                'political_status' => $political_status,
                'schools' => $schools,
                'grades' => $grades,
            ]);
        }
    }

    /**
     * Updates an existing TeacherStaff model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $selects = array('0'=>'请选择');
        $staff_type = array_merge($selects,TeacherStaff::getAllStaffType());
        $political_status = array_merge($selects,TeacherStaff::getAllPoliticalStatus());
        $schools = array_merge($selects,School::getAllSchool());
        $grades = array_merge($selects,Grade::getAllGrades());

        if ($model->load(Yii::$app->request->post())) {
            $teach_class = $model->getAttribute('teach_class');
            if(!empty($teach_class)){
                $class_array = explode(" ",trim($teach_class));
                $model->setAttribute('teach_class',serialize($class_array));
            }
            if ($model->validate() && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                echo '保存失败';
            }
        }else{
            return $this->render('update', [
                'model' => $model,
                'staff_type' => $staff_type,
                'political_status' => $political_status,
                'schools' => $schools,
                'grades' => $grades,
            ]);
        }
    }

    /**
     * Deletes an existing TeacherStaff model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $data = $this->findModel($id);
        $this->findModel($id)->delete();
//        $data = $this->findModel($id);
        $this->_eventAfterDelete($data);
        return $this->redirect(['index']);
    }

    /**
     * Finds the TeacherStaff model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TeacherStaff the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TeacherStaff::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * 创建教师职工身份后的事件集
     * @param $data
     */
    public function _eventAfterCreate($data){
        $this->on(self::EVENT_AFTER_CREATE,[$this,'_eventBindStatus'],$data);
        $this->trigger(self::EVENT_AFTER_CREATE);
    }

    /**
     * 删除教师职工身份后的事件集
     * @param $data
     */
    public function _eventAfterDelete($data){
        $this->on(self::EVENT_AFTER_DELETE,[$this,'_eventUnBindStatus'],$data);
        $this->trigger(self::EVENT_AFTER_DELETE);
    }

    public function _eventBindStatus($event){
        $status = new Status();
        $status->user_id = $event->data['user_id'];
        $status->status =$event->data['staff_type'];
        $status->name = $event->data['name'];
        $status->school = $event->data['school_name'];

        if(!$status->save()){
            throw new Exception('保存用户身份关联关系失败');
        }

        return $status->id;
    }

    public function _eventUnBindStatus($event){
        $res = Status::find()->where(['user_id'=>$event->data['user_id'],'name'=>$event->data['name']])->one();
        if($res !== null && !$res->delete()){
            echo '删除用户身份关联关系失败';
        }
    }
}
