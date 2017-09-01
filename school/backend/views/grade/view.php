<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \kartik\helpers\Enum;

/* @var $this yii\web\View */
/* @var $model common\models\Grade */

$this->title = $model->school_name.' '.$model->grade.' '.$model->room;
$this->params['breadcrumbs'][] = ['label' => '全部班级', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grade-view">
    <div class="row">
        <div class="col-lg-4">
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

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
//                    'id',
//            'school_id',
                    'grade',
                    'room',
                    'school_name',
                ],
            ]) ?>
        </div>
        <div class="col-lg-8">
            <h4>所有课程</h4>
            <?= Html::a('添加课程',"/course/update?id={$course['id']}",['class' => 'btn btn-primary'])?><br>
            <?php
                if(!$course){
                    echo "<h4>暂无课程</h4>";
                }else{
                    $course_arr = unserialize($course['course']);
//                    print_r($course['course']);
//                    print_r($course_arr);
                    echo Enum::array2table($course_arr);
                }
            ?>
        </div>
    </div>

</div>
