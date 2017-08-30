<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];


    public static function addJsScript($view,$jsFile){
        $view->registerJsFile($jsFile,[AppAsset::className(),'depends'=>'backend\assets\AppAsset']);
    }

    public static function addCssFile($view,$cssFile){
        $view->registerCssFile($cssFile,[AppAsset::className(),'depends'=>'backend\assets\AppAsset']);
    }
}
