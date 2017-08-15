<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\school\models\search\SchoolGradeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('school', 'School Grades');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-grade-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('school', 'Create School Grade'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'school_area_id',
            'school_id',
            //'dateline:datetime',
            [
                'attribute' => 'dateline',
                'value' => function ($model) {
                    if (extension_loaded('intl')) {
                        return Yii::t('user', '{0, date, MMMM dd, YYYY HH:mm}', [$model->dateline]);
                    } else {
                        return date('Y-m-d G:i:s', $model->dateline);
                    }
                },
                'filter' => DatePicker::widget([
                    'model'      => $searchModel,
                    'attribute'  => 'dateline',
                    'dateFormat' => 'php:Y-m-d',
                    'options' => [
                        'class' => 'form-control',
                    ],
                ]),
            ],
            // 'display_order',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
