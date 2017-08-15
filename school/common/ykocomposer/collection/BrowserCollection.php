<?php
/**
 * @Copyright Copyright (c) 2016 @BrowserCollection.php By Kami
 * @License http://www.yuzhai.tv/
 */
namespace common\ykocomposer\collection;

use Yii;
use yii\base\Component;
use Detection\MobileDetect;

/**
 * Class browserCollection
 * 获取用户浏览器类型
 * @Example $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
 * @package common\ykocomposer\collection
 */
class BrowserCollection extends Component
{
    protected $_mobiledetect;
    public function init(){
        parent::init();
        $this->_mobiledetect = new MobileDetect();
    }
    public function __call($name,$arguments){
        return call_user_func_array(array($this->_mobiledetect, $name), $arguments);
    }
}