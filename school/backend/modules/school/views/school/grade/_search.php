<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\search\SchoolGradeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="school-grade-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'school_area_id') ?>

    <?= $form->field($model, 'school_id') ?>

    <?= $form->field($model, 'dateline') ?>

    <?php // echo $form->field($model, 'display_order') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('school', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('school', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
