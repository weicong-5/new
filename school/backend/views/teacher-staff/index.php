<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\TeacherStaffSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '所有教师职工';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-staff-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'user_id',

            'name',
            'staff_type',
            [
                'attribute' => 'sex',
                'value' => function($data){
                    return $data->sex == 0?'男':'女';
                }
            ],
             'political_status',
            // 'tel',
            // 'school_id',
             'school_name',
            // 'office_room',
            // 'office_phone',
            // 'headteacher_grade',
            // 'headteacher_class',
            [
                'attribute' => 'subject',
                'value' => function($data){
                    return empty($data->subject)?'无':$data->subject;
                }
            ],
            // 'teach_grade',
            // 'teach_class',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
