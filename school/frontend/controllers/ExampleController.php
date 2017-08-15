<?php
/**
 * @Copyright Copyright (c) 2016 @ExampleController.php By Kami
 * @License http://www.yuzhai.tv/
 */

namespace frontend\controllers;

class ExampleController extends \yii\web\Controller
{

    // The command "yii example/index city" will call "actionIndex('city', 'name')"
    // The command "yii example/index city id" will call "actionIndex('city', 'id')"
    public function actionIndex()
    {
        //\Yii::$app->components['sms']['defaultSP'];
        \Yii::$app->sms->send(['xxx'=> [1]], 'XXT');
    }

}

