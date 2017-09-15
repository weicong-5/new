<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\School */

$this->title = $model->school_name;
$this->params['breadcrumbs'][] = ['label' => 'Schools', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-view">
    <div class="row">
        <div class="col-lg-6">
            <h4>学校信息</h4>

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
        <div class="col-lg-6">
            <h4>所有班级</h4>
            <?php Pjax::begin()?>
            <?=GridView::widget([
                'dataProvider' => $dataProvider,
//                'dataProvider' => $grades,
                'columns' => [
//                    'id',
                    'grade',
                    'room'
                ],
                'layout' => "{items}\n{pager}",//去掉summary
            ])?>
            <?php Pjax::end()?>
        </div>
    </div>
</div>
