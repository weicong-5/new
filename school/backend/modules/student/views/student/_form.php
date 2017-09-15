<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use backend\modules\student\models\Student;

/* @var $this yii\web\View */
/* @var $model backend\modules\student\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-form">

    <?php $form = ActiveForm::begin([
        'id'=>strtolower($model->formName()),
    ]); ?>

    <?= $form->field($model, 'user_id')->textInput(['type'=>'hidden'])->label(false)?>

    <?= $form->field($model, 'student_no')->textInput() ?>

    <?=Html::label('学校','school_list')?>
    <?=$form->field($model,'school_id')->dropDownList($schools,['id'=>'school_list'])->label(false)?>

    <?= $form->field($model, 'school_name')->textInput(['id'=>'school_name','type'=>'hidden'])->label(false) ?>

    <?= $form->field($model, 'student_name')->textInput(['maxlength' => true]) ?>

    <?=Html::label('性别','sex_list')?>
    <?=Html::dropDownList('sex_list',$model->sex,[0=>'男',1=>'女'],['id'=>'sex_list','class'=>'form-control'])?>

    <?= $form->field($model, 'sex')->textInput(['id'=>'sex','type'=>'hidden'])->label(false) ?>

    <?=Html::label('年级','grade_list')?>
    <?=Html::dropDownList('grade_list',Student::getSchoolIndex($model->grade,$grades),$grades,['id'=>'grade_list','class'=>'form-control'])?>

    <?= $form->field($model, 'grade')->textInput(['id'=>'grade_text','type'=>'hidden','maxlength' => true])->label(false)?>

    <?= $form->field($model, 'class_name')->textInput(['maxlength' => true]) ?>

    <?=Html::label('是否住宿','accommodate_list')?>
    <?=Html::dropDownList('accommodate_list',$model->accommodate,[0=>'否',1=>'是'],['id'=>'accommodate_list','class'=>'form-control'])?>
    <?= $form->field($model,'accommodate')->textInput(['id'=>'accommodate'])?>


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
    sex.val('0');
    sex_list.bind('change',function(){
        var selected = $('#sex_list option:selected');
        sex.val(selected.val());
    });
    grade_list.bind('change',function(){
        var selected = $('#grade_list option:selected');
        if($(this).val() == 0){
            return;
        }else{
            grade_text.val(selected.text());
        }
    });
    var accommodate_list = $('#accommodate_list'),accommodate = $('#accommodate');
    accommodate_list.bind('change',function(){
        var selected = $('#accommodate_list option:selected');
        accommodate.val(selected.val());
    });
});
JS;

$this->registerJs($script,yii\web\View::POS_LOAD);
?>