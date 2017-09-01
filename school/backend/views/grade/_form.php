<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Grade */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="grade-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'school_id')->dropDownList($schools,['id'=>'list_schools','readonly'=>$model->isNewRecord?false:true]) ?>

    <?= Html::dropDownList('list_grades',null,$grades,['id'=>'list_grades','class'=>'form-control'])?>

    <?= $form->field($model, 'grade')->textInput(['type'=>'hidden','id'=>'grade_name','maxlength' => true])->label(false)?>

    <?= $form->field($model, 'room')->textInput(['maxlength' => true]) ?>

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
