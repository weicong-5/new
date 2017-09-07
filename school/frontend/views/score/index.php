<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '个人成绩';
//$this->params['breadcrumbs'][] = $this->title;



?>
<div class="score-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!--?= Html::a('Create Score', ['create'], ['class' => 'btn btn-success']) ?>
</p-->
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'student_id',
            'comment',
            'subject',
            'score',
            // 'school',
            // 'grade',
            // 'class',

//            ['header'=>'操作','class' => 'yii\grid\ActionColumn'],
            [
                'header'=>'操作',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{score/update} {score/delete}',
                'buttons' => [
//                                'status/delete' => function($url,$model,$key){
//                                    $options = [
//                                        'title' => '查看',
//                                        'aria-label' => '查看',
//                                        'data-pjax'=>'0',
//                                    ];
//                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>',$url,$options);
//                                },
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
//                                    $options = [
//                                        'title' => '查看',
//                                        'aria-label' => '查看',
//                                        'data-pjax'=>'0',
//                                    ];
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
    ]); ?>
    <?php Pjax::end(); ?>

</div>
