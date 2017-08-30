<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Grade */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Grades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grade-view">
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
                    'id',
//            'school_id',
                    'grade',
                    'room',
                    'school_name',
                ],
            ]) ?>
        </div>
        <div class="col-lg-7">
            所有课程<br>
            <?= Html::a('添加课程',['url','[]'],['class' => 'btn btn-primary'])?><br>
            <?= $course?>
            <?php
                if(!$course){
                    echo '暂无课程';
                }else{

                }
            ?>
        </div>
    </div>

</div>
