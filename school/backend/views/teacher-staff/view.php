<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TeacherStaff */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '所有教师职工', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-staff-view">

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
            'staff_type',
            'name',
            [
                'attribute' => 'sex',
                'value' => function($data){
                    return $data->sex == 0? '男':'女';
                }
            ],
            'political_status',
            'tel',
//            'school_id',
            'school_name',
            'office_room',
            'office_phone',
            [
                'attribute'=>'headteacher_grade',
                'value'=>function($data){
                    return $data->headteacher_grade?$data->headteacher_grade:'无';
                }
            ],
            [
                'attribute'=>'headteacher_class',
                'value'=>function($data){
                    return $data->headteacher_class?$data->headteacher_class:'无';
                }
            ],
        ],
    ]) ?>

</div>
