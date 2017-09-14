<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\widgets\Breadcrumbs;
use kartik\helpers\Html;
use yii\widgets\DetailView;



?>
<?php
echo Breadcrumbs::widget([
    'homeLink' => ['label'=>'首页','url'=>['site/index']],
    'itemTemplate' => '<li>{link}</li>',
    'links' => [
        '个人中心',
    ]
]);
?>
<?php
echo "<h4 class='text-center'>用户个人资料</h4>";
?>

<?= DetailView::widget([
    'model' => $user,
    'attributes' => [
        'username',
        'email',
        [
            'attribute'=>'created_at',
            'value'=>function($data){
                return date('Y-m-d H:i:s',$data->created_at);
            }
        ],
        'last_login_at',
        [
            'attribute' => 'sex',
            'value' => function($user){//关键点！！！
                return $user->profile['sex']==0?'男':'女';
            }
        ],
        [
            'attribute' => 'political_status',
            'value' => function($user){
                return $user->profile['political_status'];
            }
        ],
        [
            'attribute' => 'phone',
            'value' => function($user){
                return $user->profile['phone'];
            }
        ]
    ],
]) ?>
<!--?>-->
