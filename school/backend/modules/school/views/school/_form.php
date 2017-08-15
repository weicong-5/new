<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\School */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
if ($this->context->action->id == 'update') {
    $id = Yii::$app->request->get('id');
    $provinceUrl = '$.pjax({url: "update?provinceid=" + $( "#school-province_id" ).val() + "&id=' . $id . '", container: \'#school-create\'});';
    $cityUrl = '$.pjax({url: "update?provinceid=" + $( "#school-province_id" ).val() + "&cityid=" +  $( "#school-city_id" ).val() + "&id=' . $id . '", container: \'#school-create\'});';
} elseif ($this->context->action->id == 'create') {
    $provinceUrl = '$.pjax({url: "create?provinceid=" + $( "#school-province_id" ).val(), container: \'#school-create\'});';
    $cityUrl = '$.pjax({url: "create?provinceid=" + $( "#school-province_id" ).val() + "&cityid=" +  $( "#school-city_id" ).val(), container: \'#school-create\'});';
}
?>
<div class="school-form">
    <?php Pjax::begin(['id' => 'school-create']); ?>
    <?php $form = ActiveForm::begin([
        //'enableAjaxValidation'   => true,
    ]); ?>

    <div class="row">
    <?php $model->province_id = empty(Yii::$app->request->get('provinceid')) ? $model->province_id : Yii::$app->request->get('provinceid') ?>
    <?= $form->field($model, 'province_id',['options' => ['class' => 'col-xs-4']])->dropDownList
        (
            ArrayHelper::map(\backend\modules\school\models\SchoolDistrict::getProvince(), 'id', 'name'),
            [
                'prompt' => '--请选择省份--',
                'onchange' => $provinceUrl,
            ]
        );
    ?>

    <?php
    if ($this->context->action->id == 'create' || !empty(Yii::$app->request->get('cityid'))) {
        $model->city_id = Yii::$app->request->get('cityid');
        $cityData = Yii::$app->request->get('provinceid') ? ArrayHelper::map(\backend\modules\school\models\SchoolDistrict::getCity(Yii::$app->request->get('provinceid')), 'id', 'name') : [];
    } elseif ($this->context->action->id == 'update') {
        $cityData = ArrayHelper::map(\backend\modules\school\models\SchoolDistrict::getCity($model->province_id), 'id', 'name');

    }
    ?>
    <?= $form->field($model, 'city_id',['options' => ['class' => 'col-xs-4']])->dropDownList
        (
            $cityData,
            [
                'prompt' => '--请选择城市--',
                'onchange'=> $cityUrl,
            ]
        );
    ?>

    <?php
    if ($this->context->action->id == 'create') {
        $areaData = Yii::$app->request->get('cityid') ? ArrayHelper::map(\backend\modules\school\models\SchoolDistrict::getArea(Yii::$app->request->get('cityid')), 'id', 'name') : [];
    } elseif ($this->context->action->id == 'update') {
        $areaData = ArrayHelper::map(\backend\modules\school\models\SchoolDistrict::getArea($model->city_id), 'id', 'name');
    }
    ?>

    <?= $form->field($model, 'area_id',['options' => ['class' => 'col-xs-4']])->dropDownList
        (
            $areaData,
            [
                'prompt' => '--请选择区域--',
            ]
        );
    ?>
    </div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'school_type')->checkboxList(
        ['0' => Yii::t('school', 'Preschool'), '1' => Yii::t('school', 'Primary school'), '2' => Yii::t('school', 'Junior high school'), '3' => Yii::t('school', 'Senior middle school')]
    ); ?>

    <?= $form->field($model, 'school_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'manage_uid')->textInput() ?>

    <?= $form->field($model, 'quantong_id')->textInput() ?>

    <?= $form->field($model, 'number')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'deny_code')->textarea(['rows' => 2]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('school', 'Create') : Yii::t('school', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>
