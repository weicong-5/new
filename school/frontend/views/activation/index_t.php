<?php
/**
 * @Copyright Copyright (c) 2016 @index.php By Kami
 * @License http://www.yuzhai.tv/
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\assets\Icheck;

Icheck::register($this);
$this->title = Yii::t('common', 'activation');
$this->params['breadcrumbs'][] = $this->title;
$this->params['body-class'] = 'login-page';

?>
<div class="login-box">
    <div class="login-logo">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <?php $form = ActiveForm::begin([
            'id'                     => 'login-form',
            'enableAjaxValidation'   => true,
            'enableClientValidation' => false,
            'validateOnBlur'         => false,
            'validateOnType'         => false,
            'validateOnChange'       => false,
        ]); ?>
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                        <?= $form->field($model, 'rememberMe', [
                            'template' => "<div class=\"checkbox icheck\">{input}{label}</div>",
                        ])->checkbox(['tabindex' => '4'],false) ?>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
                </div>
                <!-- /.col -->
            </div>
        <?php ActiveForm::end(); ?>

        <div class="social-auth-links text-center">
            <p>- OR -</p>
            <?= Html::a(Yii::t('common', 'home'), ['/'], ['class' => 'text-center btn-flat']) ?>
            <?= Html::a(Yii::t('user', 'Already registered? Sign in!'), ['/user/security/login'], ['class' => 'text-center btn-flat']) ?>
        </div>
        <!-- /.social-auth-links -->

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php
$js = <<<JS
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
JS;
$this->registerJs($js);
?>