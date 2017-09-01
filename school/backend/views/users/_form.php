<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */

$array_status = array(0=>'冻结',1=>'激活');
$array_isManager = array(0=>'否',1=>'是');

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true,'readonly'=>true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= Html::label('状态','state_list')?>
    <?= Html::dropDownList('state_list',$model->status?$model->status:1,$array_status,['id'=>'state_list','class'=>'form-control'])?>

    <?= $form->field($model, 'status')->textInput(['id'=>'state_text','type'=>'hidden'])->label(false) ?>

    <?= Html::label('管理员身份','isManager_list')?>
    <?= Html::dropDownList('isManager_list',$model->is_manager?$model->is_manager:0,$array_isManager,['id'=>'isManager_list','class'=>'form-control'])?>

    <?= $form->field($model, 'is_manager')->textInput(['id'=>'isManager_text','type'=>'hidden'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
$(document).ready(function(){
    var state_list = $('#state_list'),isManager_list = $('#isManager_list');
    var state_text = $('#state_text'),isManager_text = $('#isManager_text');
    state_list.bind('change',function(){
        var selected = $('#state_list option:selected');
        state_text.val(state_list.val());
    });
    isManager_list.bind('change',function(){
        var selected = $('#isManager_list option:selected');
        isManager_text.val(isManager_list.val());
    });
});
JS;

$this->registerJs($script,yii\web\View::POS_LOAD);
?>
