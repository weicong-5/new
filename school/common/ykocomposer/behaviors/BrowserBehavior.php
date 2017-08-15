<?php
/**
 * @Copyright Copyright (c) 2016 @BrowserBehavior.php By Kami
 * @License http://www.yuzhai.tv/
 */

namespace common\ykocomposer\behaviors;

use yii\base\Behavior;
use Yii;
use yii\web\Application;


class BrowserBehavior extends Behavior
{

    /**
     * @var string 设置cookie名
     */
    public $cookieName = '_mobile';

    public function events()
    {
        return [
            Application::EVENT_BEFORE_REQUEST => 'beforeRequest'
        ];
    }

    public function beforeRequest()
    {
        if (Yii::$app->getRequest()->getCookies()->has($this->cookieName) &&
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
    }

}