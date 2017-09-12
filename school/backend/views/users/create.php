<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = '创建';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-signup">

    <p>创建一个新用户:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['placeholder'=>'请输入合法的邮箱']) ?>

            <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'请输入密码']) ?>

            <?=Html::label('性别','sex_list')?>
            <?=Html::dropDownList('sex_list',0,[0=>'男',1=>'女'],['id'=>'sex_list','class'=>'form-control'])?>

            <?= $form->field($model, 'sex')->textInput(['id'=>'sex'])->label(false) ?>

            <?= $form->field($model,'phone')->textInput(['placeholder'=>'请输入合法的手机号码'])?>

            <?=Html::label('政治面貌','political_status_list')?>
            <?=Html::dropDownList('political_status_list',0,$political_status,['id'=>'political_status_list','class'=>'form-control'])?>

            <?= $form->field($model,'political_status')->textInput(['id'=>'political_status'])->label(false)?>

            <div class="form-group">
                <?= Html::submitButton('创建', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php
$script = <<< JS
$(document).ready(function(){
    var sex_list = $('#sex_list'),political_status_list = $('#political_status_list');
    var sex = $('#sex'),political_status = $('#political_status');
    sex.val(0);
    sex_list.bind('change',function(){
        var selected = $('#sex_list option:selected');
        sex.val(selected.val());
    });
    political_status_list.bind('change',function(){
        var selected = $('#political_status_list option:selected');
        if($(this).val() == 0){
            return false;
        }else{
            political_status.val(selected.text());
        }
    });
});
JS;

$this->registerJs($script,yii\web\View::POS_LOAD);

?>
