<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\search\SchoolSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="school-search">
    <?php Pjax::begin(['id' => 'school-search']); ?>
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?php $model->province_id = empty(Yii::$app->request->get('provinceid')) ? $model->province_id : Yii::$app->request->get('provinceid') ?>
    <?= $form->field($model, 'province_id',['options' => ['class' => '']])->dropDownList
    (
        ArrayHelper::map(\backend\modules\school\models\SchoolDistrict::getProvince(), 'id', 'name'),
        [
            'prompt' => '--请选择省份--',
            'onchange' => '$.pjax({url: "?provinceid=" + $("#schoolsearch-province_id").val(), container: \'#school-search\'});',
        ]
    );
    ?>

    <?php
        $model->city_id = Yii::$app->request->get('cityid');
        $cityData = Yii::$app->request->get('provinceid') ? ArrayHelper::map(\backend\modules\school\models\SchoolDistrict::getCity(Yii::$app->request->get('provinceid')), 'id', 'name') : [];

    ?>
    <?= $form->field($model, 'city_id',['options' => ['class' => '']])->dropDownList
    (
        $cityData,
        [
            'prompt' => '--请选择城市--',
            'onchange'=> '$.pjax({url: "?provinceid=" + $("#schoolsearch-province_id").val() + "&cityid=" +  $("#schoolsearch-city_id").val(), container: \'#school-search\'});',
        ]
    );
    ?>

    <?php
        $areaData = Yii::$app->request->get('cityid') ? ArrayHelper::map(\backend\modules\school\models\SchoolDistrict::getArea(Yii::$app->request->get('cityid')), 'id', 'name') : [];

    ?>
    <?= $form->field($model, 'area_id',['options' => ['class' => '']])->dropDownList
    (
        $areaData,
        [
            'prompt' => '--请选择区域--',
        ]
    );
    ?>

    <?php echo $form->field($model, 'address') ?>

    <?php echo $form->field($model, 'school_type') ?>

    <?php echo $form->field($model, 'school_num') ?>

    <?php echo $form->field($model, 'manage_uid') ?>

    <?php echo $form->field($model, 'quantong_id') ?>

    <?php echo $form->field($model, 'number') ?>

    <?php echo $form->field($model, 'deny_code') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('school', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('school', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>
