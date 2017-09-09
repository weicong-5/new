<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/9/9
 * Time: 15:18
 */
use kartik\helpers\Html;
use yii\widgets\Breadcrumbs;

use common\models\Student;

$student_info = Student::find()->where(['id'=>$student_id])->asArray()->one();
?>
<?php
echo Breadcrumbs::widget([
    'homeLink' => ['label'=>'首页','url'=>['site/index']],
    'itemTemplate' => '<li>{link}</li>',
    'links' => [
        [
            'label' => '本班学生',
            'url' => '/status/student-of-class'
        ],
        '个人资料',
    ]
]);
?>
    <?php
    echo Html::jumbotron(
        "<h4>学生个人资料</h4>".
        "<table class='table table-hover'>
                    <tr>
                        <td>学号</td><td>{$student_info['student_no']}</td>
                    </tr>
                    <tr>
                        <td>姓名</td><td>{$student_info['student_name']}</td>
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