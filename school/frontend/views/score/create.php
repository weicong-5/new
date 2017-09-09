<?php
use yii\widgets\Breadcrumbs;

use common\models\Student;

/* @var $this yii\web\View */
/* @var $model common\models\Score */

$this->title = '插入成绩';
$student_info = Student::find()->where(['id'=>$model->student_id])->asArray()->one();
$grade = $student_info['grade'];
$room = $student_info['class_name'];
$school = $student_info['school_name'];
?>
<div class="score-create">

    <?php
        echo Breadcrumbs::widget([
            'homeLink'=>['label'=>'首页','url'=>['site/index']],
            'itemTemplate' => '<li>{link}</li>',
            'links'=>[
                [
                    'label'=>'学生成绩',
                    'url' => ['/status/teacher-modify-score'],
                ],
                [
                    'label'=>'本班学生列表',
                    'url' => ['/status/view-room','grade'=>"{$grade}",'room'=>"{$room}",'school'=>"{$school}"],
                ],
                '插入成绩'
            ]
        ]);
    ?>

    <?= $this->render('_form', [
        'model' => $model,
        'courses_arr' => $courses_arr,
    ]) ?>

</div>
