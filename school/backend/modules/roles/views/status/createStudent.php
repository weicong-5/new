<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/8/17
 * Time: 11:23
 */

?>


<div class="row">
    <div class="col-lg-12">
        <div class="panel-title">
            <span>学生身份信息</span>
        </div>
        <div class="panel-body">
            <?php $form = \yii\bootstrap\ActiveForm::begin()?>
            <?= $form->field($model,'name')->textInput(['maxlength'=>true]) ?>

        </div>
    </div>
</div>


