<?php

namespace frontend\controllers;

use common\models\Score;
use yii\base\Exception;
use yii\filters\AccessControl;
use mdm\admin\models\User;
use yii\filters\VerbFilter;

class StatusController extends \yii\web\Controller
{
//    public function beforeAction($action)
//    {
//        $user = \Yii::$app->user;
////        print_r($user);
////        print_r($user->getId());
////        exit();
//        if($user->can('/'.$action->getUniqueId())){
//            return true;
//        }
//        if($user->getIsGuest()){
////            return \Yii::$app->getResponse()->redirect($user->loginUrl);
//            return $this->goHome();
//        }else{
//            throw new ForbiddenHttpException('You are not allowed to perform this action.');
//        }
//    }
    //行为过滤
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['teacher-dir','student-dir','insert-score'],
                'rules' => [
                    [
                        'actions' => ['teacher-dir', 'student-dir','insert-score'],
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

    public function actionStudentDir()
    {
        return $this->render('student_dir');
    }

    public function actionTeacherDir(){
        return $this->render('teacher_dir');
    }

    public function actionInsertScore(){
        $score = new Score();
        $name = 'wei';
        $times = Score::find()->where(['name'=>$name])->max('times')+1;
        return $this->render('insert_score',['times'=>$times]);
    }
}
