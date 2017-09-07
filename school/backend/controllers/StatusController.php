<?php

namespace backend\controllers;

use common\models\Student;
use common\models\TeacherStaff;
use Yii;
use common\models\Status;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StatusController implements the CRUD actions for Status model.
 */
class StatusController extends Controller
{
    //定义事件
    const EVENT_AFTER_DELETE = '_eventAfterDelete';//删除之后的事件
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
     * Lists all Status models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Status::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Status model.
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
     * Creates a new Status model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Status();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Status model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Status model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $data = $this->findModel($id);
        $this->findModel($id)->delete();
        $this->_eventAfterDelete($data);
//        $uid=$this->getUidById($id);
//        $uid = $this->getStatusById($id)['user_id'];
        return $this->redirect(['users/view','id'=>$data->user_id]);
    }

    /**
     * Finds the Status model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Status the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Status::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function _eventAfterDelete($data){
        $this->on(self::EVENT_AFTER_DELETE,[$this,'_eventUnBind'],$data);
        $this->trigger(self::EVENT_AFTER_DELETE);
    }

    public function _eventUnBind($event){
        switch($event->data['status']){
            case '学生';
                $res = Student::find()->where(['user_id'=>$event->data['user_id'],'student_name'=>$event->data['name']])->one();
                if($res !== null && !$res->delete()){
                    echo '删除用户身份关联关系失败';
                }
                break;
            case '校长':
            case '班主任':
            case '科任老师':
                $res = TeacherStaff::find()->where(['user_id'=>$event->data['user_id'],'name'=>$event->data['name']])->one();
                if($res !== null && !$res->delete()){
                    echo '删除用户身份关联关系失败';
                 }
                break;
            default:
                break;
        }
    }

    //根据id 获取身份信息中的uid
    public function getUidById($id){
        return Status::find()->where(['id'=>$id])->select('user_id');
    }

    public function getStatusById($id){
        return Status::find()->where(['id'=>$id])->asArray()->one();
    }
}
