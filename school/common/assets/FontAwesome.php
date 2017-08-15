<?php
/**
 * @Copyright Copyright (c) 2016 @FontAwesome.php By Kami
 * @License http://www.yuzhai.tv/
 */

namespace common\assets;

use yii\web\AssetBundle;

class FontAwesome extends AssetBundle
{
    public $sourcePath = '@bower/font-awesome';
    public $css = [
        'css/font-awesome.min.css'
    ];
}
