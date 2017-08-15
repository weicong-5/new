<?php
/**
 * @Copyright Copyright (c) 2016 @client.php By Kami
 * @License http://www.yuzhai.tv/
 */

namespace common\ykocomposer\components;
use SoapClient;
use SoapFault;
use yii\base\Component;
use yii\base\InvalidConfigException;


/**
 * The SOAP Client class.
 *
 * Note, PHP SOAP extension is required.
 *
 * @author Yesela <yesela@163.com>
 */
class Client extends Component
{
    /**
     * @var string $url the URL of the WSDL file.
     */
    public $url;
    /**
     * @var array the array of SOAP client options.
     */
    public $options = [];
    /**
     * @var SoapClient the SOAP client instance.
     */
    private $_client;
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->url === null) {
            throw new InvalidConfigException('WSDL接口不可用');
        }
        try {
            $this->_client = new SoapClient($this->url, $this->options);
        } catch (SoapFault $e) {
            throw new \Exception($e->getMessage(), (int) $e->getCode(), $e);
        }
    }
    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     * @throws \Exception
     */
    public function __call($name, $arguments)
    {
        try {
            return call_user_func_array([$this->_client, $name], $arguments);
        } catch (SoapFault $e) {
            throw new \Exception($e->getMessage(), (int) $e->getCode(), $e);
        }
    }
}