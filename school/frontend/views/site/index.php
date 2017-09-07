<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';

use \yii\bootstrap\Modal;
use \common\models\Status;
use \kartik\helpers\Html;

$session = Yii::$app->session;

if(!Yii::$app->user->isGuest){//如果用户登录了获取用户id和username
    $uid =  Yii::$app->user->identity->id;
    $username = Yii::$app->user->identity->username;

}

    $username=!Yii::$app->user->isGuest?$username:null;
    echo \kartik\helpers\Html::jumbotron(
        "<h2>尊敬的用户 {$username}</h2>".
        "<p>欢迎您来到旭衍生活圈</p>"
    );
?>
