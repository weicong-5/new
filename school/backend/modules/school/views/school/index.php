<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\school\models\SchoolSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('school','All schools');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-index">
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'area_id',
            'district',
            'school_name',
            'address',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'layout'=>"{items}\n{pager}",
    ]); ?>
    <?php Pjax::end(); ?>
</div>
