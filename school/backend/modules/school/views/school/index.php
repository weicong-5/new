<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use backend\modules\school\models\SchoolDistrict;

use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\school\models\search\SchoolSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('school', 'Schools');
$this->params['breadcrumbs'][] = $this->title;
?>

<p> <?= Html::button(Yii::t('school', 'Create'), ['value' => Url::to(['school/create']), 'title' => Yii::t('school', 'Create'), 'class' => 'btn btn-success','id'=>'activity-create-link']); ?>

    <?= Html::button(Yii::t('school', 'Search'), [
        'title' => Yii::t('school', 'Search'),
        'class' => 'btn btn-success',
        'data' => [
            'toggle' => 'modal',
            'target' => '#searchSchool',
        ],
    ]) ?>
</p>
<?php Modal::begin([ 'id' => 'activity-modal', 'header' => '<h4 class="modal-title"></h4>', 'size'=>'modal-lg', 'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>', ]);
    Modal::end(); ?>
<?php
    Modal::begin([
        'id' => 'searchSchool',
        'header' => '<h4 class="modal-title">' . Yii::t('school', 'Search') . '</h4>',
        'size'=>'modal-lg',
    ]);
    echo $this->render('_search', ['model' => $searchModel]);
    Modal::end();
?>
<div class="school-index">
<?php Pjax::begin(['id'=>'school-list'])?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'province_id' => [
                'attribute' => 'province_id',
                'value' => function ($model) {
                    return ArrayHelper::getValue(ArrayHelper::map(SchoolDistrict::getProvince(), 'id', 'name'), $model->province_id);
                },
                'filter' => ArrayHelper::map(SchoolDistrict::getProvince(), 'id', 'name')
            ],
            'city_id' => [
                'attribute' => 'city_id',
                'value' => function ($model) {
                    return ArrayHelper::getValue(ArrayHelper::map(SchoolDistrict::getCity($model->province_id), 'id', 'name'), $model->city_id);
                },
               //'filter' => ArrayHelper::map(SchoolDistrict::getCity(Yii::$app->request->queryParams['SchoolSearch']['province_id']), 'id', 'name'),
                'filter' => Html::activeDropDownList($searchModel, 'city_id', ArrayHelper::map(SchoolDistrict::getCity(Yii::$app->request->queryParams['SchoolSearch']['province_id']), 'id', 'name'),['class'=>'form-control','prompt' => Yii::t('school', 'Please Select {type}', ['type' => '城市']), 'options'=>[Yii::$app->request->queryParams['SchoolSearch']['city_id'] => ['selected' => true]]]),
        ],
            'area_id' => [
                'attribute' => 'area_id',
                'value' => function($model) {
                    return ArrayHelper::getValue(ArrayHelper::map(SchoolDistrict::getArea($model->city_id), 'id', 'name'), $model->area_id);
                },
                //'filter' => !empty(Yii::$app->request->queryParams['SchoolSearch']['city_id']) ? ArrayHelper::map(SchoolDistrict::getArea(Yii::$app->request->queryParams['SchoolSearch']['city_id']), 'id', 'name') : null,
                'filter' => Html::activeDropDownList($searchModel, 'area_id', ArrayHelper::map(SchoolDistrict::getArea(Yii::$app->request->queryParams['SchoolSearch']['city_id']), 'id', 'name'),['class'=>'form-control','prompt' => Yii::t('school', 'Please Select {type}', ['type' => '区域']), 'options'=>[Yii::$app->request->queryParams['SchoolSearch']['area_id'] => ['selected' => true]]]),
            ],
            // 'address',
            // 'school_type',
            // 'school_num',
            // 'manage_uid',
            // 'quantong_id',
            // 'number:ntext',
            //'deny_code:ntext',
            'deny_code' => [
                'attribute' => 'deny_code',
                'value' => function ($model) {
                    return \backend\modules\school\models\School::fieldUnSerialize($model->deny_code);
                },
            ],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>','#', [ 'class' => 'activity-view-link', 'title' => '查看', 'data-toggle' => 'modal', 'data-target' => '#activity-modal', 'data-id' => $key, 'data-pjax' => '0', ]);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>','#', [ 'class' => 'activity-update-link', 'title' => '更新', 'data-toggle' => 'modal', 'data-target' => '#activity-modal', 'data-id' => $key, 'data-pjax' => '0', ]);
                    },
                ]
            ],
        ],
    ]); ?>
<?php Pjax::end()?>
<?php $this->registerJs('
function init_click_handlers(){
    $("#activity-create-link").click(function(e) {
        $.get(
            "create",
            function (data)
            {
                $("#activity-modal").find(".modal-body").html(data);
                //$(".modal-body").html(data);
                $(".modal-title").html("创建");
                $("#activity-modal").modal("show");
            }
        );
    });

    $(".activity-view-link").click(function(e) {
        var fID = $(this).closest("tr").data("key");
        $.get(
            "view",
            {
                id: fID
            },
            function (data)
            {
                $("#activity-modal").find(".modal-body").html(data);
                //$(".modal-body").html(data);
                $(".modal-title").html("查看");
                $("#activity-modal").modal("show");
            }
        );
    });
    $(".activity-update-link").click(function(e) {
        var fID = $(this).closest("tr").data("key");
        $.get(
            "update",
            {
                id: fID
            },
            function (data)
            {
                $("#activity-modal").find(".modal-body").html(data);
                //$(".modal-body").html(data);
                $(".modal-title").html("更新");
                $("#activity-modal").modal("show");
            }
        );
    }); }
    init_click_handlers(); //first run
    $("#school-list").on("pjax:success", function() {
        init_click_handlers(); //reactivate links in grid after pjax update
    });
');?>
<?php
/*$testUrl = \yii\helpers\Url::toRoute('school/test');
$script = <<< JS
    jQuery(document).ready(function(){
        jQuery("select[name='SchoolSearch[province_id]']").change(function(evt){
            //var keys = jQuery("#w0").yiiGridView("getSelectedRows");
            jQuery.post({
                url: '{$testUrl}', // your controller action
                dataType: 'json',
                data: {keylist: $(this).val()},
                success: function(data) {
                    alert('I did it! Processed checked rows.')
                },
            });
            evt.preventDefault;
            evt.stopPropagation();
        });
    });
JS;
$this->registerJs($script);
*/
?>
</div>
