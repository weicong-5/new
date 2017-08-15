<?php
/**
 * @Copyright Copyright (c) 2016 @icheck.php By Kami
 * @License http://www.yuzhai.tv/
 */

namespace common\assets;

use yii\web\AssetBundle;

class Icheck extends  AssetBundle
{
    public $sourcePath = '@bower/adminlte/plugins';
    public $js = [
        'iCheck/icheck.min.js',
    ];
    public $css = [
        'iCheck/square/blue.css',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}