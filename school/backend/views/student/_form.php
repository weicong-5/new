<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput(['type'=>'hidden'])->label(false)?>

    <?= $form->field($model, 'student_no')->textInput() ?>

    <?=Html::label('学校','school_list')?>
    <?=$form->field($model,'school_id')->dropDownList($schools,['id'=>'school_list'])->label(false)?>

    <?= $form->field($model, 'school_name')->textInput(['id'=>'school_name','type'=>'hidden'])->label(false) ?>

    <?= $form->field($model, 'student_name')->textInput(['maxlength' => true]) ?>

    <?=Html::label('性别','sex_list')?>
    <?=Html::dropDownList('sex_list',0,[0=>'男',1=>'女'],['id'=>'sex_list','class'=>'form-control'])?>

    <?= $form->field($model, 'sex')->textInput(['id'=>'sex','type'=>'hidden'])->label(false) ?>

    <?=Html::label('年级','grade_list')?>
    <?=Html::dropDownList('grade_list',null,$grades,['id'=>'grade_list','class'=>'form-control'])?>

    <?= $form->field($model, 'grade')->textInput(['id'=>'grade_text','type'=>'hidden','maxlength' => true])->label(false)?>

    <?= $form->field($model, 'class_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'class_position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'course_id')->textInput(['type'=>'hidden'])->label(false) ?>

    <?= $form->field($model, 'score_id')->textInput(['type'=>'hidden'])->label(false) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
$(document).ready(function(){
    var school_list = $('#school_list'),sex_list = $('#sex_list'),grade_list=$('#grade_list');
    var school_name = $('#school_name'),sex = $('#sex'),grade_text=$('#grade_text');
    school_list.bind('change',function(){
        var selected = $('#school_list option:selected');
        if($(this).val() == 0){
            return;
        }else{
            school_name.val(selected.text());
        }
    });
    sex.val('男');
    sex_list.bind('change',function(){
        var selected = $('#sex_list option:selected');
        sex.val(selected.text());
    });
    grade_list.bind('change',function(){
        var selected = $('#grade_list option:selected');
        if($(this).val() == 0){
            return;
        }else{
            grade_text.val(selected.text());
        }
    });
});
JS;

$this->registerJs($script,yii\web\View::POS_LOAD);
?>