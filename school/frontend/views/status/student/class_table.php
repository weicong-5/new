<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/9/4
 * Time: 12:03
 */
use kartik\helpers\Enum;
use yii\bootstrap\Alert;
use kartik\helpers\Html;
use common\models\Student;

$session = Yii::$app->session;
$status = $session->get('status');
$user_id = $session->get('user_id');
$name = $session->get('name');

$student_info = Student::find()->where(['user_id'=>$user_id,'student_name'=>$name])->asArray()->one();
$student_info['class_position'] = Enum::isEmpty($student_info['class_position'])?'无':$student_info['class_position'];


if(Enum::isEmpty($status) || $status !== '学生'){
    echo Alert::widget([
        'options'=> [
            'class'=>'alert-danger',
        ],
        'body'=>'请选择具体的学生身份<a class="btn btn-danger btn-xs" href="/site/index">确定</a>',
    ]);
}else{
    ?>

    <?php
    echo Html::jumbotron(
        "<h4>学生个人课表</h4>"
    );
    ?>
    <?php
}
?>