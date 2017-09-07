<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = '个人成绩';
//$this->params['breadcrumbs'][] = $this->title;



?>
<div class="score-index">

    <h1><?= Html::encode($this->title) ?></h1>

        <!--?= Html::a('Create Score', ['create'], ['class' => 'btn btn-success']) ?>
    </p-->
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'student_id',
            'comment',
            'subject',
            'score',
            // 'school',
            // 'grade',
            // 'class',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>

</div>
