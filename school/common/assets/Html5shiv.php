<?php
/**
 * @Copyright Copyright (c) 2016 @Html5shiv.php By Kami
 * @License http://www.yuzhai.tv/
 */

namespace common\assets;

use yii\web\AssetBundle;

class Html5shiv extends AssetBundle
{
    public $sourcePath = '@bower/html5shiv';
    public $js = [
        'dist/html5shiv.min.js'
    ];

    public $jsOptions = [
        'condition'=>'lt IE 9'
    ];
}