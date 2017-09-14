<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\grade\models\Grade */

$this->title = $model->school_name.$model->grade.$model->room;
$this->params['breadcrumbs'][] = ['label' => Yii::t('school','All Grades'),'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grade-view">
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
            'grade',
            'room',
            'school_name',
        ],
    ]) ?>

</div>
