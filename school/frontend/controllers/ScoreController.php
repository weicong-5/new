<?php

namespace frontend\controllers;

use common\models\Course;
use common\models\Student;
use Yii;
use common\models\Score;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ScoreController implements the CRUD actions for Score model.
 */
class ScoreController extends Controller
{
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
     * Lists all Score models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'site_teacherStaff';

        $student_id = Yii::$app->request->get('sid',0);

        $dataProvider = new ActiveDataProvider([
            'query' => Score::find()->where(['student_id'=>$student_id]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Score model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = 'site_teacherStaff';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Score model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = 'site_teacherStaff';
        $student_id = Yii::$app->request->get('sid',0);

        $student_info = Student::find()->where(['id'=>$student_id])->asArray()->one();

        $courses = Course::find()->where(['school_name'=>$student_info['school_name'],'grade'=>$student_info['grade']])->asArray()->one();
        $courses_arr = unserialize($courses['course']);

        $model = new Score();
        $model->student_id = $student_id;
        $model->school = $student_info['school_name'];
        $model->grade = $student_info['grade'];
        $model->class = $student_info['class_name'];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/status/view-room', 'grade' => $model->grade,'room'=>$model->class,'school'=>$model->school]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'courses_arr'=>$courses_arr,
            ]);
        }
    }

    /**
     * Updates an existing Score model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = 'site_teacherStaff';
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
     * Deletes an existing Score model.
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
     * Finds the Score model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Score the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Score::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
