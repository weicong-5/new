<?php

use kartik\helpers\Html;
use yii\widgets\DetailView;
use kartik\helpers\Enum;

/* @var $this yii\web\View */
/* @var $model backend\modules\student\models\Student */

$this->title = $model->student_name;
$this->params['breadcrumbs'][] = ['label' => '所有学生', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-view">
    <div class="row">
        <div class="col-lg-5">
            <h4>学生信息</h4>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
//            'id',
//            'user_id',
                    'student_no',
//            'school_id',
                    'school_name',
                    'student_name',
                    [
                        'attribute'=>'sex',
                        'value'=>function($data){
                            return $data->sex==0?"男":'女';
                        }
                    ],
                    'grade',
                    'class_name',
                    [
                        'attribute'=>'accommodate',
                        'value'=>function($data){
                            return $data->accommodate==0?"否":'是';
                        }
                    ],
                    [
                        'attribute' => '班内职务',
                        'value' => function($model){
                            if($model->positions){
//                                print_r(array_column($model->positions,'position'));
                                return implode("\n",array_column($model->positions,'position'));
                            }else{
                                return '无';
                            }
                        }
                    ]
                ],
            ]) ?>
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
        <div class="col-lg-7">
            <h4>课程 <?=Html::icon('pencil');?></h4>
            <--?php
            $res = Course::find()->where(['school_id'=>$model->school_id,'grade'=>$model->grade])->asArray()->one();
            if($res){
                echo Enum::array2table(unserialize($res['course']));
            }else{
                echo '暂无课程';
            }
            ?>
            <h4>成绩</h4>
        </div>
    </div>

</div>
