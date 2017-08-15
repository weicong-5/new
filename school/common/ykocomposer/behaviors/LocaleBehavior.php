<?php
/**
 * @Copyright Copyright (c) 2016 @LocaleBehavior.php By Kami
 * @License http://www.yuzhai.tv/
 */

namespace common\ykocomposer\behaviors;

use Yii;
use yii\web\Application;
use yii\base\Behavior;

class LocaleBehavior extends Behavior
{
    /**
     * @var string 设置一个COOKIE名称为 _locale
     */
    public $cookieName = '_locale';

    /**
     * @var bool 是否启用首选语言
     */
    public $enablePreferredLanguage = true;

    /**
     * @return array 触发事件处理器
     */
    public function events()
    {
        return [
            Application::EVENT_BEFORE_REQUEST => 'beforeRequest',
        ];
    }

    /**
     * 事件请求之前获取用户cookie, 首选语言配置等设置选择相应的语言文件
     * @return void
     */
    public function beforeRequest()
    {
        if (Yii::$app->getRequest()->getCookies()->has($this->cookieName)
            && !Yii::$app->session->hasFlash('forceUpdateLocale')
        ) {
            $userLocale = Yii::$app->getRequest()->getCookies()->getValue($this->cookieName);
        } else {
            $userLocale = Yii::$app->language;
            // @todo 注释部分需要配置USER模块的locale
            /*if (!Yii::$app->user->isGuest && Yii::$app->user->identity->userProfile->locale) {
                $userLocale = Yii::$app->user->getIdentity()->userProfile->locale;
            } else*/if ($this->enablePreferredLanguage) {
                $userLocale = Yii::$app->request->getPreferredLanguage($this->getAvailableLocales());
            }
        }
        Yii::$app->language = $userLocale;
    }

    /**
     * @example /common/config/params-local.php availableLocales
     * @return array 获取语言数组键名
     */
    protected function getAvailableLocales()
    {
        return array_keys(Yii::$app->params['availableLocales']);
    }
}