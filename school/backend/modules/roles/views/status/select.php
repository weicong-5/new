<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/8/17
 * Time: 10:04
 */
use \yii\widgets\ActiveForm;

$id=Yii::$app->request->get('uid',0);
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel-title">
<!--            <span>请选择角色</span>-->
        </div>
        <div class="panel-body">
            <?php $form =ActiveForm::begin()?>
            <?= $form->field($model,'rolename')->dropDownList($roles,['prompt'=>'请选择角色','onchange'=>'
            $("#select").val($("#roles-rolename").val())'])?>
            <div class="form-group">
                <?= \yii\helpers\Html::a('确定',['create?uid='.$id.'&rid='],['class'=>'btn btn-primary','onclick'=>'$(this).attr("href",$(this).attr("href")+$("#roles-rolename").val())'])?>
            </div>
            <input type="hidden" id="select">
            <?php ActiveForm::end()?>
        </div>

    </div>
</div>

<script>
    console.log($('#roles-rolename').val());
</script>
