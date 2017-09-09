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
use yii\widgets\Breadcrumbs;

//$this->title = '教师个人信息';
//$this->params['breadcrumbs'][]  = '教师个人信息';

$session = Yii::$app->session;
$status = $session->get('status');
$user_id = $session->get('user_id');
$name = $session->get('name');

$teacher_info = TeacherStaff::find()->where(['user_id'=>$user_id,'name'=>$name])->asArray()->one();
$teacher_info['sex'] = $teacher_info['sex'] == 0?'男':'女';
//如果表示班主任 获取不到班主任所任班级          办公电话可以是空值
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
    echo Breadcrumbs::widget([
        'homeLink' => ['label'=>'首页','url'=>['site/index']],
        'itemTemplate' => "<li>{link}</li>\n",//全局模板
        'links' => [
            '教师个人信息'
        ]
    ]);
    $content = "<table class='table table-hover'>
                    <tr>
                        <td>姓名</td><td>{$teacher_info['name']}</td>
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
                        <td>职位</td><td>{$teacher_info['staff_type']}</td>
                    </tr>";
    if($teacher_info['staff_type'] == '班主任'){
        $content = $content."<tr>
                        <td>任班主任所在年级</td><td>{$teacher_info['headteacher_grade']}</td>
                    </tr>
                    <tr>
                        <td>任班主任所在班级</td><td>{$teacher_info['headteacher_class']}</td>
                    </tr>";
    }
    $content = $content."<tr>
                        <td>办公室</td><td>{$teacher_info['office_room']}</td>
                    </tr>
                    <tr>
                        <td>办公电话</td><td>{$teacher_info['office_phone']}</td>
                    </tr>";
    if($teacher_info['staff_type'] != '校长'){
        $content = $content."<tr>
                        <td>所教科目</td><td>{$teacher_info['subject']}</td>
                    </tr>
                    <tr>
                        <td>所教年级</td><td>{$teacher_info['teach_grade']}</td>
                    </tr>";
    }
    $content = $content.
                "</table>";
    echo Html::jumbotron(
        "<h4>教师个人信息</h4>".$content
//        "<table class='table table-hover'>
//                    <tr>
//                        <td>姓名</td><td>{$teacher_info['name']}</td>
//                    </tr>
//                    <tr>
//                        <td>性别</td><td>{$teacher_info['sex']}</td>
//                    </tr>
//                    <tr>
//                        <td>政治面貌</td><td>{$teacher_info['political_status']}</td>
//                    </tr>
//                    <tr>
//                        <td>手机号码</td><td>{$teacher_info['tel']}</td>
//                    </tr>
//                    <tr>
//                        <td>所在学校</td><td>{$teacher_info['school_name']}</td>
//                    </tr>
//                    <tr>
//                        <td>职位</td><td>{$teacher_info['staff_type']}</td>
//                    </tr>
//                    <tr>
//                        <td>办公室</td><td>{$teacher_info['office_room']}</td>
//                    </tr>
//                    <tr>
//                        <td>办公电话</td><td>{$teacher_info['office_phone']}</td>
//                    </tr>
//                    <tr>
//                        <td>所教科目</td><td>{$teacher_info['subject']}</td>
//                    </tr>
//                </table>"
    );
    ?>
    <?php
}
?>