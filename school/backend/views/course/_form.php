<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Course */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="course-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'school_id')->dropDownList($schools,['id'=>'list_schools']) ?>

    <?= Html::dropDownList('list_grades',null,$grades,['id'=>'list_grades','class'=>'form-control'])?>

    <?= $form->field($model,'grade')->textInput(['type'=>'hidden','id'=>'grade_name','maxlength'=>'true'])->label(false) ?>

    <?= $form->field($model, 'course')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script =<<< JS
    $(document).ready(function(){
        var grade_text = $('#grade_name');
        var grade_list = $('#list_grades');
        grade_list.bind('change',function(){
            var selected = $('#list_grades option:selected');
            if($(this).val() == 0){
                return;
            }else{
                grade_text.val(selected.text());
            }
        });
    });
JS;

$this->registerJs($script);

?>