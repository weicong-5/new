<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Course */

$this->title = $model->school_name.' '.$model->grade;
$this->params['breadcrumbs'][] = ['label' => '各学校各年级', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-view">

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
//            'school_id',
//            'grade',
//            'course:ntext',
            [
                'attribute' => 'course',
                'value' => function($data){
                    $arr = unserialize($data->course);
                    return implode(" ",$arr);
                },
            ],
        ],
    ]) ?>

</div>
