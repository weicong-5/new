<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/8/17
 * Time: 11:23
 */
use yii\widgets\ActiveForm;
//$schools = \common\models\School::getAllSchool();
?>
<div class="row">
    <div class="col-lg-9">
        <div class="panel-title">
            学生身份信息
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin()?>
            <?= $form->field($model,'name')->textInput(['maxlength'=>true])?>
            <?= $form->field($model,'student_num')->textInput(['maxlength'=>true])?>
            <?= $form->field($model,'sex')->dropDownList(['1'=>'男','2'=>'女'])?>
            <?= $form->field($model,'school_id')->dropDownList($schools)?>
            <?= $form->field($model,'grade_id')->dropDownList(['1'=>'一年级','2'=>'二年级','3'=>'三年级','4'=>'四年级','5'=>'五年级'
            ,'6'=>'六年级','7'=>'初一','8'=>'初二','9'=>'初三','10'=>'高一','11'=>'高二','12'=>'高三'])?>
            <?= $form->field($model,'class_id')->textInput()?>
            <div class="form-group">
                <?= \yii\helpers\Html::submitButton('确定',['class'=>'btn btn-primary'])?>
            </div>
            <?php ActiveForm::end()?>
        </div>
    </div>
</div>





