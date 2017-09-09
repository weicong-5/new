<?php

namespace frontend\controllers;

use common\models\Score;
use common\models\StudentSearch;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;


class StatusController extends Controller
{
    public $layout = 'site_student';

    //行为过滤
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['student-index','teacher-index','insert-score'],
                'rules' => [
//                    [
//                        'actions' => ['teacher-index'],
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
                    [
                        'actions' => ['student-index','insert-score','teacher-index'],
                        'allow' => true,
                        'roles' => ['@'],//表示只有登录之后才能访问
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '*' => ['get','post'],//所有方法都可以是get post方式
                ],
            ],
        ];
    }



    public function actionStudentIndex()
    {
//        $this->layout = 'site_student';
        return $this->render('student/index');
    }

    public function actionSchoolInfo(){
//        $status = \Yii::$app->session->get('status');
        $url = \Yii::$app->request->getReferrer();
        if(strpos($url,'student')){
            $this->layout = 'site_student';
        }
        if(strpos($url,'teacher')){
            $this->layout = 'site_teacherStaff';
        }
        return $this->render('school_info');
    }

    public function actionStudentClassTable(){
//        $this->layout = 'site_student';
        return $this->render('student/class_table');
    }

    public function actionStudentScore(){
//        $this->layout = 'site_student';
        return $this->render('student/score');
    }
    //---------------------------------------------------TeacherStaff
    public function actionTeacherIndex(){
        $this->layout = 'site_teacherStaff';
        return $this->render('teacher/index');
    }

    public function actionTeacherModifyScore(){
        $this->layout = 'site_teacherStaff';
        return $this->render('teacher/modify_score');
    }

    //查看某年级某班级内所有学生
    public function actionViewRoom(){
        $this->layout = 'site_teacherStaff';
        $grade = \Yii::$app->request->get('grade',0);
        $room = \Yii::$app->request->get('room',0);
        $school = \Yii::$app->request->get('school',0);
        $searchModel = new StudentSearch();
        return $this->render('teacher/students_of_room',[
            'grade' => $grade,
            'room' => $room,
            'school' => $school,
            'searchModel'=> $searchModel,
        ]);
    }

    //班主任查看本班的所有学生
    public function actionStudentOfClass(){
        $this->layout = 'site_teacherStaff';
        $searchModel = new StudentSearch();
        return $this->render('teacher/students_of_class',[
            'searchModel' => $searchModel,
        ]);
    }

    public function actionPersonalInfo(){
        $this->layout = 'site_teacherStaff';
        $student_id = \Yii::$app->request->get('sid',0);
        return $this->render('teacher/personal_info',[
            'student_id' => $student_id,
        ]);
    }

    //-------------------------------------------------关于成绩
    public function actionInsertScore(){
        $this->layout = 'site_teacherStaff';
        $student_id = \Yii::$app->request->get('sid',0);
        return $this->render('/score/create',[
            'student_id' => $student_id,
        ]);
    }


//    public function actionInsertScore(){
//        $score = new Score();
//        $name = 'wei';
//        $times = Score::find()->where(['name'=>$name])->max('times')+1;
//        return $this->render('insert_score',['times'=>$times]);
//    }
    //--------------------------------------------------------Parent
    public function actionParentIndex(){
        $this->layout = 'site_parent';
        return $this->render('parent/index');
    }
}
