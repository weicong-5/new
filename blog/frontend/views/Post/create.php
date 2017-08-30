<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/8/8
 * Time: 10:55
 *
 */
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
$this->title = '创建文章';

//面包屑导航
$this->params['breadcrumbs'][] = ['label'=>'文章列表','url'=>['post/index']];
$this->params['breadcrumbs'][] =  $this->title;

$script = <<< JS
$(document).ready(function(){
    var text = $('#text');
    var select = $('#postform-cat_id');
    //var options = $('#postform-cat_id option:selected');
    select.bind("change",function(){
        var options = $('#postform-cat_id option:selected');
        if($(this).val() == 0){
            return;
        }else{
            //alert(opts[$(this).val()].text());
            //alert(options.text());
            text.val(options.text());
        }
    });
});
JS;
$this->registerJs($script);



?>

<div class="row">
    <div class="col-lg-9">
        <div class="panel-title box-title">
            <span>创建文章</span>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model,'title')->textInput(['maxlength'=>true]) ?>
            <?= $form->field($model,'cat_id')->dropDownList($cats) ?>
<!--            <input type="hidden" id="text">-->
            <?= $form->field($model,'cat_name')->textInput(['type'=>'hidden','id'=>'text'])->label(false)?>
            <?= $form->field($model,'label_img')->widget('common\widgets\file_upload\FileUpload',[
                'config' => []//图片上传的一些配置，不写调用默认配置
            ])?>
            <?= $form->field($model,'content')->textarea()?>
            <!--标签引用组件tags 无需配置 只需要在调用的地方引用即可 -->
            <?= $form->field($model,'tags')->widget('common\widgets\tags\TagWidget')?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('common','Create'),['class'=>'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end() ?>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="panel-title box-title">
            <span><?= Yii::t('common','Precautions')?></span>
        </div>
        <div class="panel-body">
            <ol>
                <li>xxxxxxxxxxxxxxxx</li>
                <li>xxxxxxxxxxxxxxxx</li>
            </ol>
        </div>
    </div>
</div>