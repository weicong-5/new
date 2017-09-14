<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use kartik\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;

$this->context->layout = 'main';
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email')->textInput(['placeholder'=>'请输入合法的邮箱']) ?>

                <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'请输入密码']) ?>

                <?= Html::label('性别','sex_list')?>
                <?= Html::dropDownList('sex_list',0,$sex_list,['id'=>'sex_list','class'=>'form-control'])?>

                <?= $form->field($model,'sex')->textInput(['id'=>'sex','type'=>'hidden'])->label(false)?>

                <?= $form->field($model,'phone')->textInput()?>

                <?= Html::label('政治面貌','political_list')?>
                <?= Html::dropDownList('political_list',0,$political_list,['id'=>'political_list','class'=>'form-control'])?>

                <?= $form->field($model,'political_status')->textInput(['id'=>'political','type'=>'hidden'])->label(false)?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


<?php
$script = <<< JS
$(document).ready(function(){
    var sex_list = $('#sex_list'),sex = $('#sex');
    sex.val(0);//默认值
    sex_list.bind('change',function(){//性别选择框事件
        var selected = $('#sex_list option:selected');
        sex.val(selected.val());
    });

    var political_list = $('#political_list'), political = $('#political');
    political_list.bind('change',function(){
        var selected = $('#political_list option:selected');
        if($(this).val() == 0){
            return;
        }else{
            political.val(selected.text());
        }
    });
})
JS;

$this->registerJs($script,yii\web\View::POS_LOAD);

?>
