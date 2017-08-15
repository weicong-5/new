<?php
/**
 * @Copyright Copyright (c) 2016 @AdminLteAsset.php By Kami
 * @License http://www.yuzhai.tv/
 */

namespace common\assets;

use yii\web\AssetBundle;

/**
 * AdminLte AssetBundle
 * @since 0.1
 */
class AdminLteAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        //'css/style.css'
    ];
    public $js = [
        //'js/app.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'common\assets\AdminLte',
        'common\assets\Html5shiv'
    ];
}