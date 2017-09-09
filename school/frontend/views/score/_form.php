<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Score */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="score-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'student_id')->textInput(['type'=>'hidden'])->label(false) ?>

    <?=Html::label('科目','subject_list')?>
    <?=Html::dropDownList('subject_list',array_search($model->subject,$courses_arr),$courses_arr,['class'=>'form-control','id'=>'subject_list'])?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true,'id'=>'subject_text','type'=>'hidden'])->label(false)?>

    <?= $form->field($model, 'score')->textInput(['maxlength' => true,'id'=>'score']) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true,'id'=>'comment_text','type'=>'hidden'])->label(false) ?>

    <?= $form->field($model, 'school')->textInput(['maxlength' => true,'type'=>'hidden'])->label(false) ?>

    <?= $form->field($model, 'grade')->textInput(['maxlength' => true,'type'=>'hidden'])->label(false) ?>

    <?= $form->field($model, 'class')->textInput(['maxlength' => true,'type'=>'hidden'])->label(false) ?>

    <?php //对备注字段进行操作 取出考试类型和次数
    $type = $model->isNewRecord?'单元考':substr($model->comment,strpos($model->comment,'次')+3);
    $pattern = '/\d+/';
    preg_match($pattern,$model->comment,$times);

    ?>

    <div class="form-inline">
        <div class="form-group">
            <?=Html::label('考试类型','type_select')?>
            <?=Html::radioList('type_select',$type,array('单元考'=>'单元考','期中考'=>'期中考','期末考'=>'期末考'),['class'=>'checkbox','id'=>'type_select'])?>
        </div>
        <div class="form-group">
            <?=Html::label('第几次','times_text')?>
            <?=Html::textInput('times_text',$model->isNewRecord ?null:$times[0],['id'=>'times_text','class'=>'form-control','placeholder'=>'第几次某类型考试'])?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '插入' : 'Update', ['id'=>'sure','class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
$(document).ready(function(){
    var subject_list = $('#subject_list');
    var subject_text = $('#subject_text');
    var selected = $('#subject_list option:selected');
    var comment_text = $('#comment_text');
    subject_text.val(selected.text());
    subject_list.bind('change',function(){
        var selected = $('#subject_list option:selected');
        if($(this).val() == 0){
            return;
        }else{
            subject_text.val(selected.text());
        }
    });
    var type_select = $('#type_select'),times_text = $('#times_text');
    var type=$(':radio[name=type_select]:checked').val();
    $(':radio').click(function(){
        //alert($(this).val());
        //comment_text.val($(this).val());
        type = $(this).val();
        comment_text.val('第'+$('#times_text').val()+'次'+type);
    });
    times_text.bind('input propertychange',function(){
        comment_text.val('第'+$(this).val()+'次'+type);
    });
    times_text.bind('keydown',function(e){
        var code = parseInt(e.keyCode);
        if(code>=96 && code<=105 || code>=48 && code<=57 || code==8){//code=8 是Backspace
            return true;
        }else{
            return false;
        }
    });
    var sure = $('#sure');//获取插入按钮
    times_text.bind('blur',function(e){//文本框失去焦点时判断是否有填入第几次 如果有  插入按钮才生效
        if($(this).val() == ''){
            sure.attr({"disabled":"disabled"});
        }else{
            sure.removeAttr('disabled');
        }
    });
    if(times_text.val()==''){
        sure.attr({"disabled":"disabled"});
    }
    var score = $('#score');
    //验证分数输入的有效性
    score.bind('keydown',function(e){
        var code = parseInt(e.keyCode);
        if(code>=96 && code<=105 || code>=48 && code<=57 || code==8 || code==110){
            return true;
        }else{
            return false;
        }
    });
    score.bind('blur',function(){
        if($(this).val() >= 130){
            sure.attr({"disabled":"disabled"});
        }else{
            sure.removeAttr('disabled');
        }
    });
});
JS;

$this->registerJs($script,\yii\web\View::POS_LOAD);

?>