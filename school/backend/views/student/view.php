<?php


use yii\widgets\DetailView;
use \common\models\Course;
use \kartik\helpers\Enum;
use \kartik\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Student */

$this->title = $model->student_name;
$this->params['breadcrumbs'][] = ['label' => '所有学生', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-view">
    <div class="row">
        <div class="col-lg-5">
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
//            'id',
//            'user_id',
                    'student_no',
//            'school_id',
                    'school_name',
                    'student_name',
                    'sex',
                    'grade',
                    'class_name',
                    'class_position',
                    'score_id',
                ],
            ]) ?>
        </div>
        <div class="col-lg-7">
            <h4>课程 <?=Html::icon('pencil');?></h4>
            <?php
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
