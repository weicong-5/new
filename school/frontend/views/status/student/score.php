<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/9/6
 * Time: 15:19
 */
use kartik\helpers\Enum;
use yii\bootstrap\Alert;
use kartik\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\Breadcrumbs;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

use common\models\Student;
use common\models\Score;

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
}else {
    ?>

    <?php Pjax::begin(); ?>
    <?php
//    print_r($student_info);
    echo Breadcrumbs::widget([
        'homeLink' => ['label' => '首页', 'url' => ['site/index']],
        'itemTemplate' => '<li>{link}</li>',
        'links' => [
            '个人成绩'
        ]
    ]);
    ?>
    <h2><span><?= Html::encode($name) ?></span> <?= Html::encode($this->title) ?></h2>
    <?php
    foreach ($examType as $item) {
        if (empty($subject)) {
            $query = Score::find()->where(['student_id' => $student_id, 'comment' => $item]);
        } else {
            $query = Score::find()->where(['student_id' => $student_id, 'comment' => $item, 'subject' => $subject]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        ?>
        <h4><?= Html::encode($item) ?></h4>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'subject',
                'score',
                [
                    'header' => '排名',

                ],
            ],
            'layout' => "{items}\n{pager}",
        ]); ?>
        <?php
    }
    ?>

    <?php Pjax::end(); ?>
    <?php
}?>
