<?php
/**
 * @Copyright Copyright (c) 2016 @AdminLte.php By Kami
 * @License http://www.yuzhai.tv/
 */

namespace common\assets;

use yii\web\AssetBundle;

class AdminLte extends AssetBundle
{
    public $sourcePath = '@bower/adminlte/dist';
    public $js = [
        'js/app.js',
        'js/demo.js'
    ];
    public $css = [
        'css/AdminLTE.min.css',
        'css/skins/_all-skins.min.css'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'common\assets\FontAwesome',
    ];
}