<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/9/11
 * Time: 14:42
 */
use yii\widgets\Breadcrumbs;
use kartik\helpers\Html;

echo Breadcrumbs::widget([
    'homeLink' => ['label'=>'首页','url'=>['site/index']],
    'itemTemplate' => '<li>{link}</li>',
    'links' => [
        '布置作业',
    ]
]);

echo Html::jumbotron(
    "<h4>布置作业</h4>"
);
?>