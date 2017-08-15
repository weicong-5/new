<?php
/**
 * @Copyright Copyright (c) 2016 @CoreController.php By Kami
 * @License http://www.yuzhai.tv/
 */

namespace common\ykocomposer\controller;

use Yii;
use yii\web\Controller;


/**
 * Class CoreController
 * 继承控制器, 以此控制器为核心
 * @package common\ykocomposer\controller
 */
class CoreController extends Controller
{

    public function init()
    {
        $this->setLanguage();
        $this->setBrowserType();
    }

    public function setLanguage()
    {
        if(isset($_GET['lang']) && $_GET['lang'] != "") {
            // 根据传递的网址获取lang, 然后更改语言.
            Yii::$app->language = htmlspecialchars($_GET['lang']);

            // 根据传递值获取到的cookie(yii\web\CookieCollection)
            $cookies = Yii::$app->response->cookies;

            // 增加一个新的cookie记录
            $cookies->add(new \yii\web\Cookie([
                'name' => 'lang',
                'value' => htmlspecialchars($_GET['lang']),
                'expire' => time() + (365 * 24 * 60 * 60),
            ]));
        } elseif (isset(Yii::$app->request->cookies['lang']) &&
            Yii::$app->request->cookies['lang']->value != "") {
            Yii::$app->language = Yii::$app->request->cookies['lang']->value;
        } elseif (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $lang = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
            Yii::$app->language = $lang[0];
        } else {
            Yii::$app->language = 'zh-CN';
        }
    }

    public function setBrowserType()
    {
        if (isset(Yii::$app->request->cookies['mobile']) &&
            (Yii::$app->getBrowser->isMobile() || Yii::$app->getBrowser->isTablet()))
        {
            Yii::$app->view->theme  = Yii::createObject([
                'class' => 'yii\base\Theme',
                'pathMap'=>[
                    '@backend/views' => '@backend/views/touch',
                    '@frontend/views' => '@frontend/views/touch',
                ]
            ]);
        }
        if ((isset($_GET['mobile']) && $_GET['mobile'] != 'no'))
        {
            $cookies = Yii::$app->response->cookies;
            $cookies->add(new \yii\web\Cookie([
                'name' => 'mobile',
                'value' => 'yes',
                'expire' => time() + 3600,
            ]));
            //echo Yii::$app->request->userAgent;
            //$deviceType = (Yii::$app->getBrowser->isMobile() ? (Yii::$app->getBrowser->isTablet() ? 'tablet' : 'phone') : 'computer');

        } elseif (isset($_GET['mobile']) && $_GET['mobile'] == 'no')
        {
            $cookies = Yii::$app->response->cookies;
            $cookies->remove('mobile');
            print_r(1);
        }
    }
}
