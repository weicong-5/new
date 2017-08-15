<?php
/**
 * @Copyright Copyright (c) 2016 @Inputmask.php By Kami
 * @License http://www.yuzhai.tv/
 */

namespace common\assets;

use yii\web\AssetBundle;
class InputMask extends AssetBundle
{
    public $sourcePath = '@bower/adminlte/plugins';
    public $js = [
        'input-mask/jquery.inputmask.js',
        'input-mask/jquery.inputmask.date.extensions.js',
        'input-mask/jquery.inputmask.extensions.js',
    ];
    public $css = [

    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}