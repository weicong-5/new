<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/9/6
 * Time: 11:19
 */
use common\models\TeacherStaff;
use kartik\helpers\Enum;
use yii\bootstrap\Alert;
use kartik\helpers\Html;

$session = Yii::$app->session;
$status = $session->get('status');
$user_id = $session->get('user_id');
$name = $session->get('name');

$teacher_info = TeacherStaff::find()->where(['user_id'=>$user_id,'name'=>$name])->asArray()->one();
$teacher_info['sex'] = $teacher_info['sex'] == 0?'男':'女';
@$teacher_info['office_room'] = Enum::isEmpty($teacher_info['office_room'])?'无':$teacher_info['office_room'];
@$teacher_info['office_phone'] = Enum::isEmpty($teacher_info['office_phone'])?'无':$teacher_info['office_phone'];


if(Enum::isEmpty($status) || !in_array($status,TeacherStaff::getAllStaffType())){
    echo Alert::widget([
        'options'=> [
            'class'=>'alert-danger',
        ],
        'body'=>'请选择具体的教师职工身份<a class="btn btn-danger btn-xs" href="/site/index">确定</a>',
    ]);
}else{
    ?>

    <?php
    echo Html::jumbotron(
        "<h4>教师个人信息</h4>".
        "<table class='table table-hover'>
                    <tr>
                        <td>姓名</td><td>{$teacher_info['name']}</td>
                    </tr>
                    <tr>
                        <td>职位</td><td>{$teacher_info['staff_type']}</td>
                    </tr>
                    <tr>
                        <td>性别</td><td>{$teacher_info['sex']}</td>
                    </tr>
                    <tr>
                        <td>政治面貌</td><td>{$teacher_info['political_status']}</td>
                    </tr>
                    <tr>
                        <td>手机号码</td><td>{$teacher_info['tel']}</td>
                    </tr>
                    <tr>
                        <td>所在学校</td><td>{$teacher_info['school_name']}</td>
                    </tr>
                    <tr>
                        <td>办公室</td><td>{$teacher_info['office_room']}</td>
                    </tr>
                    <tr>
                        <td>办公电话</td><td>{$teacher_info['office_phone']}</td>
                    </tr>
                </table>"
    );
    ?>
    <?php
}
?>