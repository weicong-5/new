<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\School */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Schools', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-view">
    <div class="row">
        <div class="col-lg-6">
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
//                    'area_id',
                    'school_name',
                    'address',
                    'district',
                ],
            ]) ?>
        </div>
        <div class="col-lg-6">
            <h4>所有班级</h4>
            <?php Pjax::begin()?>
            <?=GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    'grade',
                    'room'
                ]
            ])?>
            <?php Pjax::end()?>
        </div>
    </div>
</div>
