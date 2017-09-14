<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\School */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="school-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'area_id')->dropDownList($areas,['id'=>'area_list']) ?>

    <?= $form->field($model, 'school_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'district')->textInput(['id'=>'district_text','type'=>'hidden','maxlength' => true])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
$(document).ready(function(){
    var area_list = $('#area_list');
    var district = $('#district_text');
    area_list.bind('change',function(){
        var selected = $('#area_list option:selected');
        if($(this).val() == 0){
            return;
        }else{
            district.val(selected.text().replace(/-/g,''));//将区域信息的横线去掉再存入数据库
        }

    });
});
JS;

$this->registerJs($script,yii\web\View::POS_LOAD);
?>
