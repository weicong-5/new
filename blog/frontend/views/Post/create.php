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
            <?= $form->field($model,'label_img')->widget('common\widgets\file_upload\FileUpload',[
                'config' => []//图片上传的一些配置，不写调用默认配置
            ])?>
            <?= $form->field($model,'content')->widget('common\widgets\ueditor\Ueditor',[
                'options' =>[
                    'initialFrameHeight' => 400,
                    //定制菜单
                    'toolbars' => [
                        [
                            'fullscreen', 'source', 'undo', 'redo', '|',
                            'fontsize',
                            'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat',
                            'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|',
                            'forecolor', 'backcolor', '|',
                            'lineheight', '|',
                            'indent', '|'
                        ],
                    ]
                    //默认全部引用
                ]
            ])?>
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