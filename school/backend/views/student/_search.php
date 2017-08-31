<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StudentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'student_no') ?>

    <?= $form->field($model, 'school_id') ?>

    <?= $form->field($model, 'school_name') ?>

    <?php // echo $form->field($model, 'student_name') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'grade') ?>

    <?php // echo $form->field($model, 'class_name') ?>

    <?php // echo $form->field($model, 'class_position') ?>

    <?php // echo $form->field($model, 'course_id') ?>

    <?php // echo $form->field($model, 'score_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
