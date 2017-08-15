<?php
/**
 * @Copyright Copyright (c) 2016 @SetLocaleAction.php By Kami
 * @License http://www.yuzhai.tv/
 */

namespace common\ykocomposer\actions;

use yii\base\Action;
use yii\base\InvalidParamException;
use Yii;
use yii\web\Cookie;

/**
 * 此文件是对语言进行重新设置的class
 * Class SetLocaleAction
 * @package common\ykocomposer\actions
 *
 * Example:
 *
 *   public function actions()
 *   {
 *       return [
 *           'set-locale'=>[
 *               'class'=>'common\ykocomposer\actions\SetLocaleAction',
 *               'locales'=>[
 *                   'en-US', 'ru-RU', 'ua-UA', 'zh-CN'     //语言目录标签
 *               ],
 *               'localeCookieName'=>'_locale',             //系统cookie名字
 *               'callback'=>function($action){             //回调函数进行跳转
 *                   return $this->controller->redirect(/.. some url ../)
 *               }
 *           ]
 *       ];
 *   }
*/

class SetLocaleAction extends Action
{
    /**
     * @var array 可用语言设置列表
     */
    public $locales;

    /**
     * @var string cookie名称
     */
    public $localeCookieName = '_locale';

    /**
     * @var integer cookie存活期
     */
    public $cookieExpire;

    /**
     * @var string cookie域名
     */
    public $cookieDomain;

    /**
     * @var \Closure 回调匿名函数
     */
    public $callback;


    /**
     * 当set-locale触发时, 对语言cookie进行重新设置以及加载, 并跳转到刷新前的网址
     * @param $locale
     * @return mixed|static
     */
    public function run($locale)
    {
        if (!is_array($this->locales) || !in_array($locale, $this->locales, true)) {
            throw new InvalidParamException('未知的语言');
        }
        $cookie = new Cookie([
            'name' => $this->localeCookieName,
            'value' => $locale,
            'expire' => $this->cookieExpire ?: time() + 60 * 60 * 24,
            'domain' => $this->cookieDomain ?: '',
        ]);
        Yii::$app->getResponse()->getCookies()->add($cookie);
        if ($this->callback && $this->callback instanceof \Closure) {
            return call_user_func_array($this->callback, [
                $this,
                $locale
            ]);
        }
       return Yii::$app->response->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
    }
}
