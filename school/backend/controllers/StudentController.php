<?php

namespace backend\controllers;

use common\models\Course;
use common\models\Grade;
use common\models\School;
use common\models\Status;
use Yii;
use common\models\Student;
use common\models\StudentSearch;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StudentController implements the CRUD actions for Student model.
 */
class StudentController extends Controller
{

    //定义事件
    const EVENT_AFTER_CREATE = 'eventAfterCreate';//创建之后的事件
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
     * Lists all Student models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Student model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($user_id,$status)
    {
        $model = new Student();
        $model->setAttribute('user_id', $user_id);
        $schools = array('0'=>'请选择');
        $schools = array_merge($schools,School::getAllSchool());

        $grades = array('0'=>'请选择');
        $grades = array_merge($grades,Grade::getAllGrades());

        if($model->load(Yii::$app->request->post())) {
            //根据学校id和年级找到课程id  插入student表中的courseID
            $course = Course::find()->where(['school_id' => $model->school_id, 'grade' => $model->grade])->asArray()->one();
            if ($course) {
                $model->setAttribute('course_id', $course['id']);
            }

            if($model->validate() && $model->save()){
                $data = $model->getAttributes();
                $data['status'] = $status;
                $this->_eventAfterCreate($data);
                return $this->redirect(['view','id'=>$model->id]);
            }else{
                echo '保存失败';
            }
        }else{
            return $this->render('create',[
                'model'=>$model,
                'schools'=>$schools,
                'grades'=>$grades,
            ]);
        }
    }

    /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $schools = array('0'=>'请选择');
        $schools = array_merge($schools,School::getAllSchool());

        $grades = array('0'=>'请选择');
        $grades = array_merge($grades,Grade::getAllGrades());

        if($model->load(Yii::$app->request->post())) {
            $course = Course::find()->where(['school_id' => $model->school_id, 'grade' => $model->grade])->asArray()->one();
            if ($course) {
                $model->setAttribute('course_id', $course['id']);
            }

            if($model->validate() && $model->save()){
                return $this->redirect(['view','id'=>$model->id]);
            }else{
                echo '保存失败';
            }
        }else{
            return $this->render('create',[
                'model'=>$model,
                'schools'=>$schools,
                'grades'=>$grades,
            ]);
        }
    }

    /**
     * Deletes an existing Student model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param $data
     * 创建学生身份后的事件集
     */
    public function _eventAfterCreate($data){
        $this->on(self::EVENT_AFTER_CREATE,[$this,'_eventBindStatus'],$data);
        $this->trigger(self::EVENT_AFTER_CREATE);
    }

    public function _eventBindStatus($event){
        $status = new Status();
        $status->user_id = $event->data['user_id'];
        $status->status = $event->data['status'];
        $status->name = $event->data['student_name'];
        $status->school = $event->data['school_name'];

        if(!$status->save()){
            throw new Exception('保存用户身份关联关系失败');
        }
        return $status->id;
    }
}
