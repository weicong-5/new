<?php
/**
 * @Copyright Copyright (c) 2016 @index.php By Kami
 * @License http://www.yuzhai.tv/
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use common\assets\Icheck;
use common\assets\InputMask;

Icheck::register($this);
InputMask::register($this);
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
        <p class="login-box-msg"><?= Yii::t('common', 'Please enter your phone verification') ?></p>

        <?php $form = ActiveForm::begin([
            'id'                     => 'resend-form',
            'enableAjaxValidation'   => true,
            'enableClientValidation' => false,
            'validateOnBlur'         => false,
            'validateOnType'         => false,
            'validateOnChange'       => false,
        ]); ?>
            <?= $form->field($model, 'phone', [
                'template' => "{label}<div class=\"input-group\"><div class=\"input-group-addon\"><i class=\"fa fa-phone\"></i>+86</div>{input}</div>\n<span class=\"help-block\">{error}</span>"
            ])->textInput() ?>

            <div class="row">
                <div class="col-xs-8">
                    <?= $form->field($model, 'code', [
                        'template' => "<div class=\"input-group\"><div class=\"input-group-addon\"><i class=\"fa fa-unlock-alt\"></i></div>{input}</div>\n<span class=\"help-block\">{error}</span>"
                    ])->textInput() ?>
                </div>

                <div class="col-xs-4">
                    <?= Html::buttonInput(Yii::t('common', 'Get captcha'), ['class' => 'btn btn-primary btn-block btn-flat pull-right', 'name' => 'code' ,'id' => 'code']);?>
                </div>
            </div>

            <?= $form->field($model, 'password', [
                'template' => "{label}<div class=\"input-group\"><div class=\"input-group-addon\"><i class=\"fa fa-keyboard-o\"></i></div>{input}</div>\n<span class=\"help-block\">{error}</span>"
            ])->passwordInput() ?>

            <div class="row">
                <!-- /.col -->
                <div class="col-xs-4">
                    <?= Html::submitButton(Yii::t('common', 'confirm'), ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
                </div>
                <!-- /.col -->
            </div>
        <?php ActiveForm::end(); ?>

        <div class="social-auth-links text-center">
            <p>- OR -</p>
            <?= Html::a(Yii::t('common', 'home'), ['/'], ['class' => 'text-center btn-flat']) ?><br>
            <?= Html::a(Yii::t('user', 'Already registered? Sign in!'), ['/user/security/login'], ['class' => 'text-center btn-flat']) ?>
        </div>
        <!-- /.social-auth-links -->

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php
    $checkMobileExistsUrl = \yii\helpers\Url::toRoute('activation/check-mobile-exists');
    $sendCodeUrl = \yii\helpers\Url::toRoute('activation/send-login-code');
$js = <<<JS
    jQuery("[data-mask]").inputmask();
    jQuery("document").ready(function(){
        jQuery("#code").click(function (){
            sendCode(jQuery("#code"));
        });
        v = getCookieValue("secondsremained_login") ? getCookieValue("secondsremained_login") : 0;//获取cookie值
        if( v > 0 ){
            setTime(jQuery("#code"));//开始倒计时
        }
    });

    function sendCode(obj){
        var mobile = jQuery("#{$model->formName()}-phone").val();
        //检查手机是否合法
        var result = isPhoneNum();
        if(result){
            //检查手机号码是否存在
            var exists_result = dbCheckMobileExists('{$checkMobileExistsUrl}', {"phone":mobile});
            if(exists_result){
                exists_result = doPostBack('{$sendCodeUrl}',{"phone":mobile});
                if (exists_result) {
                    addCookie("secondsremained_login",60,60);//添加cookie记录,有效时间60s
                    setTime(obj);//开始倒计时
                }
            }
        }
    }

    //检查手机号码是否存在
    function dbCheckMobileExists(url,queryParam){
        var bool = false;
        jQuery.ajax({
            async : false,
            cache : false,
            type : 'POST',
            url : url,// 请求的action路径
            data:queryParam,
            error : function() {// 请求失败处理函数
            },
            success:function(result){
                if (result == 'Success') {
                    bool = true;
                } else if (result == 'Failed') {
                    alert('该手机号码不存在！');
                } else if (result == 'HasConfirmed') {
                    alert('该手机号码已激活, 不用重新激活');
                }
            }
        });
        return bool;
    }
    //将手机利用ajax提交到后台的发短信接口
    function doPostBack(url,queryParam) {
        var bool = false;
        var data = jQuery('#{$model->formName()}').serialize();
        jQuery.ajax({
            async : false,
            cache : false,
            type : 'POST',
            url : url,// 请求的action路径
            data : data,
            error : function() {// 请求失败处理函数
            },
            success:function(result){
                if(result == 'Success'){
                    alert('短信发送成功，验证码10分钟内有效,请注意查看手机短信。如果未收到短信，请在60秒后重试！');
                    bool = true;
                } else {
                    alert('短信发送失败，请和网站客服联系！');
                }
            }
        });
        return bool;
    }

    //开始倒计时
    var countdown;
    function setTime(obj) {
        countdown=getCookieValue("secondsremained_login") ? getCookieValue("secondsremained_login") : 0;
        if (countdown == 0) {
            obj.removeAttr("disabled");
            obj.val("获取验证码");
            return;
        } else {
            obj.attr("disabled", true);
            obj.val(countdown + "秒后重发");
            countdown--;
            editCookie("secondsremained_login",countdown,countdown+1);
        }
        setTimeout(function() { setTime(obj) },1000) //每1000毫秒执行一次
    }

    //校验手机号是否合法
    function isPhoneNum(){
        var phonenum = jQuery("#{$model->formName()}-phone").val();
        var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
        if(!myreg.test(phonenum)){
            alert('请输入有效的手机号码！');
            jQuery("#{$model->formName()}-phone").focus();
            return false;
        }else{
            return true;
        }
    }

    //发送验证码时添加cookie
    function addCookie(name,value,expiresHours){
        var cookieString=name+"="+escape(value);
        //判断是否设置过期时间,0代表关闭浏览器时失效
        if(expiresHours>0){
            var date=new Date();
            date.setTime(date.getTime()+expiresHours*1000);
            cookieString=cookieString+";expires=" + date.toUTCString();
        }
        document.cookie=cookieString;
    }
    //修改cookie的值
    function editCookie(name,value,expiresHours){
        var cookieString=name+"="+escape(value);
        if(expiresHours>0){
            var date=new Date();
            date.setTime(date.getTime()+expiresHours*1000); //单位是毫秒
            cookieString=cookieString+";expires=" + date.toGMTString();
        }
        document.cookie=cookieString;
    }
    //根据名字获取cookie的值
    function getCookieValue(name){
        var strCookie=document.cookie;
        var arrCookie=strCookie.split("; ");
        for(var i=0;i<arrCookie.length;i++){
            var arr=arrCookie[i].split("=");
            if(arr[0]==name){
                return unescape(arr[1]);
                break;
            }
        }

    }

JS;
$this->registerJs($js);
?>