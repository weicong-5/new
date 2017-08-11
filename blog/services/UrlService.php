<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/8/10
 * Time: 17:53
 */
namespace app\services;

use \yii\helpers\Url;

Class UrlService{
    //返回一个内部链接
    public static function buildUrl($uri,$params=[]){
        return Url::toRoute(array_merge([$uri],$params));
    }

    //返回一个空链接
    public static function buildNullUrl(){
        return "javascript::void(0)";
    }
}