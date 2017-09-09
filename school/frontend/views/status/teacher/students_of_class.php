<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/9/9
 * Time: 11:36
 * 本班学生页
 */
use kartik\helpers\Enum;
use kartik\helpers\Html;
use yii\bootstrap\Alert;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\Breadcrumbs;
use \yii\data\ActiveDataProvider;

use common\models\TeacherStaff;
use common\models\Student;

$session = Yii::$app->session;
$status = $session->get('status');
$user_id = $session->get('user_id');
$name = $session->get('name');

$teacher_info = TeacherStaff::find()->where(['user_id'=>$user_id,'name'=>$name])->asArray()->one();
$school_name = $teacher_info['school_name'];$grade = $teacher_info['headteacher_grade'];$class = $teacher_info['headteacher_class'];
$query = Student::find()->where(['school_name'=>$school_name,'grade'=>$grade,'class_name'=>$class])->orderBy('student_no');

//$dataProvider = new ActiveDataProvider([
//    'query'=>$query,
//    'pagination'=>[
//        'pagesize'=>10,
//    ]
//]);
$dataProvider = $searchModel->search(\Yii::$app->request->queryParams,$query);


if(Enum::isEmpty($status) || !in_array($status,TeacherStaff::getAllStaffType())){
    echo Alert::widget([
        'options'=> [
            'class'=>'alert-danger',
        ],
        'body'=>'请选择具体的教师职工身份<a class="btn btn-danger btn-xs" href="/site/index">确定</a>',
    ]);
}else{
    ?>

    <?php Pjax::begin(); ?>
    <?php
    echo Breadcrumbs::widget([
        'homeLink' => ['label'=>'首页','url'=>['site/index']],
        'itemTemplate' => '<li>{link}</li>',
        'links' => [
            '本班学生',
        ]
    ]);
    ?>
    <h2>本班学生</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'student_no',
                'filter'=> Html::activeTextInput($searchModel,'student_no',[
                    'class'=>'form-control'
                ])
            ],
            [
                'attribute'=>'student_name',
                'filter'=> Html::activeTextInput($searchModel,'student_name',[
                    'class'=>'form-control'
                ])
            ],
            [
                'label' => '操作',
                'format'=>'raw',
                'value' => function($data){
//                    $url = 'view-room?grade='.$data->grade.'&room='.$data->room.'&school='.$data->school_name;//少个学校参数
                    $url ="/status/personal-info?sid=".$data->id;
                    $url2 = "/score/personal?sid=".$data->id;
                    return Html::a('个人资料',$url,['title'=>'查看','class'=>'btn btn-xs btn-primary'])." ".Html::a('个人成绩',$url2,['title'=>'查看','class'=>'btn btn-xs btn-success']);
                }
            ],
        ],
        'layout'=>"{items}\n{pager}",
    ]);
    ?>
    <?php Pjax::end(); ?>
    <?php
}
?>