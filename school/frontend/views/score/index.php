<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\data\ActiveDataProvider;
use yii\widgets\Breadcrumbs;

use common\models\Score;
use common\models\Student;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/**
 * 前台的分数页
 */
$this->title = '个人成绩';
$student_info = Student::find()->where(['id'=>$student_id])->asArray()->one();
$grade = $student_info['grade'];
$room = $student_info['class_name'];
$school = $student_info['school_name'];

$session = Yii::$app->session;
$subject = $session->get('subject');
//$headteacher = $session->get('headteacher');

?>
<div class="score-index">
    <!--?= Html::a('Create Score', ['create'], ['class' => 'btn btn-success']) ?>
</p-->
    <?php Pjax::begin(); ?>
    <?php
//    print_r($student_info);
    echo Breadcrumbs::widget([
        'homeLink' => ['label'=>'首页','url'=>['site/index']],
        'itemTemplate' => '<li>{link}</li>',
        'links' => [
            [
                'label'=>'学生成绩',
                'url'=>['/status/teacher-modify-score'],
            ],
            [
                'label'=>'本班学生列表',
                'url'=>['/status/view-room','grade'=>"{$grade}",'room'=>"{$room}",'school'=>"{$school}"],
                //'grade'=>$student_info['grade'],'room'=>$student_info['class_name'],'school'=>$student_info['school_name']
            ],
            '个人成绩'
        ]
    ]);
    ?>
    <h2><span><?=Html::encode($student_name)?></span>  <?= Html::encode($this->title) ?></h2>
    <?php
    foreach($examType as $item){
        if(empty($subject)){
            $query = Score::find()->where(['student_id'=>$student_id,'comment'=>$item]);
        }else{
            $query = Score::find()->where(['student_id'=>$student_id,'comment'=>$item,'subject'=>$subject]);
        }
        $dataProvider= new ActiveDataProvider([
            'query' => $query,
        ]);
        ?>
            <h4><?= Html::encode($item)?></h4>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class'=>'yii\grid\SerialColumn'],
                    'subject',
                    'score',
                    [
                    'header'=>'操作',
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{score/update} {score/delete}',
                    'buttons' => [
                        'score/update' => function($url,$model,$key){
                            $options = [
                                'class' => 'btn btn-xs btn-primary',
                                'title' => '修改',
                                'aria-label' => '修改',
                                'data-pjax'=>'1',
                            ];
                            return Html::a('<span class="glyphicon glyphicon-edit"></span>',$url,$options);
                        },
                        'score/delete' => function($url,$model,$key){
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>',$url,[
                                'class' => 'btn btn-xs btn-danger',
                                'title' => '删除',
                                'aria-label' => '删除',
                                'data-pjax'=>'1',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ]
                            ]);
                        },
                    ],
                ],
                ],
                'layout'=>"{items}\n{pager}",
            ]);?>
    <?php
        }
    ?>

    <?php Pjax::end(); ?>

</div>
