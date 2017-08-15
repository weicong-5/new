<?php
/**
 * @Copyright Copyright (c) 2016 @ExampleController.php By Kami
 * @License http://www.yuzhai.tv/
 */

namespace console\controllers;

class ExampleController extends \yii\console\Controller
{

    // The command "yii example/index city" will call "actionIndex('city', 'name')"
    // The command "yii example/index city id" will call "actionIndex('city', 'id')"
    public function actionIndex()
    {
        $t =  \Yii::$app->sms->send(['xxx'=> [1]], 'XXT');
        var_dump($t);
    }

}

