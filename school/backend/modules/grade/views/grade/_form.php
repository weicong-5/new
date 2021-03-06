<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use backend\modules\grade\models\Grade;

/* @var $this yii\web\View */
/* @var $model backend\modules\grade\models\Grade */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="grade-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::label('学校','list_schools')?>
    <?= $form->field($model, 'school_id')->dropDownList($schools,['id'=>'list_schools','disabled'=>$model->isNewRecord?false:true])->label(false) ?>

    <?= Html::label('年级','list_grades')?>
    <?= Html::dropDownList('list_grades',Grade::getIndex($model->grade),$grades,['id'=>'list_grades','class'=>'form-control'])?>

    <?= $form->field($model, 'grade')->textInput(['type'=>'hidden','id'=>'grade_name','maxlength' => true])->label(false)?>

    <?= $form->field($model, 'room')->textInput(['maxlength' => true,'placeholder'=>'例如1班']) ?>

    <?= $form->field($model, 'school_name')->textInput(['type'=>'hidden','id'=>'school_name','maxlength' => true])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php

$script = <<<JS
    $(document).ready(function(){
        var school_name = $('#school_name'),grade_name=$('#grade_name');
        var school_list = $('#list_schools');
        var grade_list = $('#list_grades')
        school_list.bind('change',function(){
            var selected = $('#list_schools option:selected');
            if($(this).val() == 0){
                return;
            }else{
                //alert(selected.text());
                school_name.val(selected.text());
            }
        });
        grade_list.bind('change',function(){
            var selected = $('#list_grades option:selected');
            if($(this).val() == 0){
                return;
            }else{
                grade_name.val(selected.text());
            }
        });
    });
JS;


$this->registerJs($script,\yii\web\View::POS_LOAD);
?>
