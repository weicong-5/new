<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\SchoolGrade */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="school-grade-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'school_id',['options' => ['class' => '']])->dropDownList
    (
        ArrayHelper::map(\backend\modules\school\models\search\SchoolSearch::find()->all(), 'id', 'name'),
        [
            'prompt' => '--请选择学校--',
        ]
    );
    ?>

    <?= $form->field($model, 'display_order')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('school', 'Create') : Yii::t('school', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
