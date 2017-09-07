<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/9/4
 * Time: 11:54
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
        "<h4>学生个人信息</h4>".
        "<table class='table table-hover'>
                    <tr>
                        <td>学号</td><td>{$student_info['student_no']}</td>
                    </tr>
                    <tr>
                        <td>姓名</td><td>{$name}</td>
                    </tr>
                    <tr>
                        <td>性别</td><td>{$student_info['sex']}</td>
                    </tr>
                    <tr>
                        <td>学校</td><td>{$student_info['school_name']}</td>
                    </tr>
                    <tr>
                        <td>年级</td><td>{$student_info['grade']}</td>
                    </tr>
                    <tr>
                        <td>班级</td><td>{$student_info['class_name']}</td>
                    </tr>
                    <tr>
                        <td>班内职务</td><td>{$student_info['class_position']}</td>
                    </tr>
                </table>"
    );
    ?>
    <?php
}
?>