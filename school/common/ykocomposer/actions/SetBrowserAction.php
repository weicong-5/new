<?php
/**
 * @Copyright Copyright (c) 2016 @SetBrowserAction.php By Kami
 * @License http://www.yuzhai.tv/
 */

namespace common\ykocomposer\actions;

use yii\base\Action;
use yii\base\InvalidParamException;
use Yii;
use yii\web\Cookie;
/**
 * 此文件是对语言进行重新设置的class
 * Class SetBrowserAction
 * @package common\ykocomposer\actions
 *
 * Example:
 *
 *   public function actions()
 *   {
 *       return [
 *           'set-browser'=>[
 *               'class'=>'common\ykocomposer\actions\SetBrowserAction',
 *               'mobiles'=>[
 *                   '1', '2', '3', 'yes', 'no'             //浏览器类型标签: 1:Mobile ; 2:Tablet ; 3:Computer 
 *               ],
 *               'mobileCookieName'=>'_mobile',             //系统cookie名字
 *               'callback'=>function($action){             //回调函数进行跳转
 *                   return $this->controller->redirect(/.. some url ../)
 *               }
 *           ]
 *       ];
 *   }
*/

class SetBrowserAction extends Action
{
    /**
     * @var array 可用浏览器设置列表
     */
    public $mobiles = ['1', '2', '3', 'yes', 'no'];

    /**
     * @var string cookie名称
     */
    public $mobileCookieName = '_mobile';

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
     * 当set-mobile触发时, 对语言cookie进行重新设置以及加载, 并跳转到刷新前的网址
     * @param $mobile
     * @return mixed|static
     */
    public function run($mobile)
    {
        if (!is_array($this->mobiles) || !in_array($mobile, $this->mobiles, true))
        {
            throw new InvalidParamException('未知的浏览器类型');
        }
        if ($mobile == 'no')
        {
            var_dump(Yii::$app->response->cookies->remove($this->mobileCookieName));
        } else
        {
            $cookie = new Cookie([
                'name' => $this->mobileCookieName,
                'value' => $mobile,
                'expire' => $this->cookieExpire ?: time() + 60 * 60 * 24,
                'domain' => $this->cookieDomain ?: '',
            ]);
            Yii::$app->getResponse()->getCookies()->add($cookie);
        }
        if ($this->callback && $this->callback instanceof \Closure)
        {
            return call_user_func_array($this->callback, [
                $this,
                $mobile
            ]);
        }
       return Yii::$app->response->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
    }
}
