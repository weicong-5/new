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



            <div class="form-group">
                <?= Html::submitButton('创建', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
