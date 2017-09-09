<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/8/12
 * Time: 17:01
 */
use kartik\helpers\Html;
use yii\widgets\Breadcrumbs;


echo Breadcrumbs::widget([
    'homeLink' => ['label'=>'首页','url'=>['site/index']],
    'itemTemplate' => '<li>{link}</li>',
    'links'=>[
        '学校资讯',
    ]
]);

echo Html::jumbotron(
    "<h4>学校众多资讯、通知</h4>"
);
echo Html::jumbotron(
    "<h4>学校荣誉</h4>"
);




