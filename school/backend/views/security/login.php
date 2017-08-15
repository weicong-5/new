<?php
/**
 * @Copyright Copyright (c) 2016 @login.php By Kami
 * @License http://www.yuzhai.tv/
 */

use dektrium\user\widgets\Connect;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View                   $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module           $module
 */

$this->title = Yii::t('user', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id'                     => 'login-form',
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                    'validateOnBlur'         => false,
                    'validateOnType'         => false,
                    'validateOnChange'       => false,
                ]) ?>

                <?= $form->field($model, 'login', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1', ]]) ?>

                <?= $form->field($model, 'password', ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2']])->passwordInput()->label(Yii::t('user', 'Password') . ($module->enablePasswordRecovery ? ' (' . Html::a(Yii::t('user', 'Forgot password?'), ['/user/recovery/request'], ['tabindex' => '5']) . ')' : '')) ?>

                <?= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '4']) ?>

                <?= Html::submitButton(Yii::t('user', 'Sign in'), ['class' => 'btn btn-primary btn-block', 'tabindex' => '3']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <?php if ($module->enableConfirmation): ?>
            <p class="text-center">
                <?= Html::a(Yii::t('user', 'Didn\'t receive confirmation message?'), ['/user/registration/resend']) ?>
            </p>
        <?php endif ?>
        <?php if ($module->enableRegistration): ?>
            <p class="text-center">
                <?= Html::a(Yii::t('user', 'Don\'t have an account? Sign up!'), ['/user/registration/register']) ?>
            </p>
        <?php endif ?>
        <?= Connect::widget([
            'baseAuthUrl' => ['/user/security/auth'],
        ]) ?>
    </div>
    <?php
    $url =  Yii::$app->urlManager->createUrl('activation/index');
    $js = <<<JS
    $('form#{$model->formName()}').on('afterValidate', function(e) {
    var form = $(this);
    if(form.find('.help-block').eq(0).text().indexOf('确认')) {
        $.ajax({
            url    : '{$url}',
            type   : 'post',
            success: function (response)
            {
                layer.open({
                    type: 2,
                    shade: [0.8, '#393D49'],
                    area: ['400px', '600px'],
                    title: '您的账号需要激活, 请激活您的账号', //不显示标题
                    content: '{$url}', //捕获的元素

                });
                //swal({title: "您所使用的用户必须激活!", text: response, html: true, confirmButtonText :'取消'});
                /*layer.open({
                    type: 1,
                    shade: [0.8, '#393D49'],

                    title: '您的账号需要激活, 请激活您的账号', //不显示标题
                    content: response, //捕获的元素

                });*/
            },
            error  : function ()
            {
                console.log('internal server error');
            }
        });

    }

   e.preventDefault();
})/*.on('submit', function(e){
        e.preventDefault();
    });*/
JS;
    $this->registerJs($js);
    $this->registerAssetBundle(\frontend\assets\AppAsset::className());
    ?>
</div>
