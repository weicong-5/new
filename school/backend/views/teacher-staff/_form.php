<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\models\TeacherStaff;
use common\models\Course;
/* @var $this yii\web\View */
/* @var $model common\models\TeacherStaff */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teacher-staff-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput(['type'=>'hidden'])->label(false) ?>

    <?=Html::label('职工身份','staff_type_list')?>
    <?=Html::dropDownList('staff_type_list',TeacherStaff::getStaffTypeIndex($model->staff_type,$staff_type),$staff_type,['id'=>'staff_type_list','class'=>'form-control'])?>

    <?= $form->field($model, 'staff_type')->textInput(['id'=>'staff_type_text','maxlength' => true,'type'=>'hidden'])->label(false) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?=Html::label('性别','sex_list')?>
    <?=Html::dropDownList('sex_list',$model->sex,[0=>'男',1=>'女'],['id'=>'sex_list','class'=>'form-control'])?>

    <?= $form->field($model, 'sex')->textInput(['id'=>'sex','type'=>'hidden'])->label(false) ?>

    <?=Html::label('政治面貌','political_status_list')?>
    <?=Html::dropDownList('political_status_list',TeacherStaff::getPoliticalIndex($model->political_status,$political_status),$political_status,['id'=>'political_status_list','class'=>'form-control'])?>

    <?= $form->field($model, 'political_status')->textInput(['id'=>'political_status_text','maxlength' => true,'type'=>'hidden'])->label(false)?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <?=Html::label('学校','school_list')?>
    <?= $form->field($model, 'school_id')->dropDownList($schools,['id'=>'school_list'])->label(false) ?>

    <?= $form->field($model, 'school_name')->textInput(['id'=>'school_name','maxlength' => true,'type'=>'hidden'])->label(false) ?>

    <?= $form->field($model, 'office_room')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'office_phone')->textInput(['maxlength' => true]) ?>

    <?=Html::label('任班主任所在年级','grade_list',['id'=>'grade_label','class'=>'hidden'])?>
    <?=Html::dropDownList('grade_list',0,$grades,['id'=>'grade_list','class'=>'form-control hidden'])?>

    <?= $form->field($model, 'headteacher_grade')->textInput(['maxlength' => true,'id'=>'headteacher_grade','class'=>'hidden'])->label(false) ?>

    <?=Html::label('任班主任所在班级','headteacher_class',['id'=>'class_label','class'=>'hidden'])?>
    <?= $form->field($model, 'headteacher_class')->textInput(['maxlength' => true,'id'=>'headteacher_class','class'=>'hidden form-control'])->label(false) ?>

    <?=Html::label('所教科目','subject_list',['id'=>'subject_label','class'=>'hidden'])?>
    <?=Html::dropDownList('subject_list',0,Course::getAllCourse(),['id'=>'subject_list','class'=>'hidden form-control'])?>
    <?=$form->field($model,'subject')->textInput(['maxlength'=>true,'id'=>'subject_text','class'=>'hidden form-control'])->label(false)?>

    <?=Html::label('所教年级','teach_grade_list',['id'=>'teach_grade_label','class'=>'hidden'])?>
    <?=Html::dropDownList('teach_grade_list',0,$grades,['id'=>'teach_grade_list','class'=>'form-control hidden'])?>

    <?= $form->field($model, 'teach_grade')->textInput(['maxlength' => true,'id'=>'teach_grade','type'=>'hidden'])->label(false) ?>

    <?=Html::label('所教班级(班级之间以空格隔开)','teach_class',['id'=>'teach_class_label','class'=>'hidden'])?>
    <?=$form->field($model, 'teach_class')->textarea(['id'=>'teach_class','class'=>'form-control hidden'])->label(false)?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
$(document).ready(function(){
    var staff_type_list = $('#staff_type_list'),sex_list = $('#sex_list'),political_status_list = $('#political_status_list'),school_list = $('#school_list');
    var staff_type_text = $('#staff_type_text'),sex = $('#sex'),political_status_text = $('#political_status_text'),school_name = $('#school_name');
    var grade_label = $('#grade_label'),grade_list = $('#grade_list'),class_label = $('#class_label');
    var headteacher_grade = $('#headteacher_grade'),headteacher_class = $('#headteacher_class');
    var subject_list = $('#subject_list'),subject_text = $('#subject_text'),subject_label = $('#subject_label');
    var teach_grade_list = $('#teach_grade_list'),teach_grade = $('#teach_grade'),teach_grade_label = $('#teach_grade_label');
    var teach_class_label = $('#teach_class_label'),teach_class = $('#teach_class');
    staff_type_list.bind('change',function(){
        var selected = $('#staff_type_list option:selected');
        if($(this).val() == 0){
            staff_type_text.val("");
            grade_label.addClass('hidden');
            grade_list.addClass('hidden');
            class_label.addClass('hidden');
            headteacher_class.addClass('hidden');
            subject_label.addClass('hidden');
            subject_list.addClass('hidden');
            return false;
        }else if($(this).val() == 2){
            staff_type_text.val(selected.text());
            grade_label.removeClass('hidden');
            grade_list.removeClass('hidden');
            class_label.removeClass('hidden');
            headteacher_class.removeClass('hidden');
            subject_label.removeClass('hidden');
            subject_list.removeClass('hidden');
            teach_grade_list.removeClass('hidden');
            teach_grade_label.removeClass('hidden');
            teach_class_label.removeClass('hidden');
            teach_class.removeClass('hidden');
        }else if($(this).val() == 3){//科任老师
            staff_type_text.val(selected.text());
            subject_label.removeClass('hidden');
            subject_list.removeClass('hidden');
            teach_grade_list.removeClass('hidden');
            teach_grade_label.removeClass('hidden');
            teach_class_label.removeClass('hidden');
            teach_class.removeClass('hidden');
            grade_label.addClass('hidden');
            grade_list.addClass('hidden');
            class_label.addClass('hidden');
            headteacher_class.addClass('hidden');
        }else{
            staff_type_text.val(selected.text());
            grade_label.addClass('hidden');
            grade_list.addClass('hidden');
            class_label.addClass('hidden');
            headteacher_class.addClass('hidden');
            subject_label.addClass('hidden');
            subject_list.addClass('hidden');
            teach_grade_list.addClass('hidden');
            teach_grade_label.addClass('hidden');
            teach_class_label.addClass('hidden');
            teach_class.addClass('hidden');
        }
    });
    sex.val('0');
    sex_list.bind('change',function(){
        var selected = $('#sex_list option:selected');
        sex.val(selected.val());
    });
    political_status_list.bind('change',function(){
        var selected = $('#political_status_list option:selected');
        if($(this).val() == 0){
            political_status_text.val("");
            return false;
        }else{
            political_status_text.val(selected.text());
        }
    });
    school_list.bind('change',function(){
        var selected = $('#school_list option:selected');
        if($(this).val() == 0){
            school_name.val("");
            return false;
        }else{
            school_name.val(selected.text());
        }
    });
    grade_list.bind('change',function(){
        var selected = $('#grade_list option:selected');
        if($(this).val() == 0){
            headteacher_grade.val("");
            return false;
        }else{
            headteacher_grade.val(selected.text());
        }
    });
    subject_list.bind('change',function(){
        var selected = $('#subject_list option:selected');
        if($(this).val() == 0){
            subject_text.val("");
            return false;
        }else{
            subject_text.val(selected.text());
        }
    });
    teach_grade_list.bind('change',function(){
        var selected = $('#teach_grade_list option:selected');
        if($(this).val() == 0){
            teach_grade.val("");
            return false;
        }else{
            teach_grade.val(selected.text());
        }
    });
});
JS;

$this->registerJs($script,yii\web\View::POS_LOAD);

?>
