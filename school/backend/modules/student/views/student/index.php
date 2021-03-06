<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\student\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '所有学生';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'user_id',
            'student_no',
//            'school_id',
            'student_name',
            'school_name',
            // 'sex',
            // 'grade',
            // 'class_name',
            // 'accommodate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'layout'=>"{items}\n{pager}",
    ]); ?>
<?php Pjax::end(); ?></div>
