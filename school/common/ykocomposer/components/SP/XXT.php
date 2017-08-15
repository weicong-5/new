<?php
/**
 * @Copyright Copyright (c) 2016 @XXT.php By Kami
 * @License http://www.yuzhai.tv/
 */

namespace common\ykocomposer\components\SP;

use common\ykocomposer\components\Client;
use Yii;
use common\ykocomposer\components\BaseSms;
use common\ykocomposer\components\SP\XXTThread;

class XXT extends BaseSms
{
    public $wsdl;
    public $login;
    public $soap;

    private $Version = '2.05';
    private $MsgSeq = '1';
    private $MsgType;
    private $TimeStamp;
    private $PerFormCode;
    private $PlatFormKey;
    private $Skey;
    private $MsgBody;
    private $SecretKey;

    private $data = [];

    public function __construct()
    {
        $this->PerFormCode = 'czxsz';
        $this->PlatFormKey = 'e157b054-e03c-4f1c-84d8-74b739903ad5';
        $this->wsdl = 'http://api.ydxxt.com/services/eduSOAP?wsdl';
        $this->login = '1';
        $this->TimeStamp = date('Y-m-d H:i:s', time());
        //$this->TimeStamp = Yii::$app->formatter->asDate('now', 'Y-m-d H:i:s');
        //echo $this->TimeStamp;
        //\Yii::error('22321312312', 'sms');
        /*try {
            $this->soap = new \SoapClient($this->wsdl, ["trace" => true, "connection_timeout" => 200]);
        } catch (\Exception $e) {
            \Yii::error("调用接口失败", 'sms');
            throw new \yii\web\HttpException(500, '与短信模块通信不应期, 请稍后再进行重试, 或跟我们客服联系!');
        }*/
        //return $this;
    }


    /**
     * 设置签名
     * @return string
     */
    public function getsKey()
    {
        $this->Skey = strtoupper(md5($this->PerFormCode . $this->TimeStamp . $this->MsgSeq . $this->MsgType . $this->PlatFormKey));
        return $this->Skey;
    }


    /**
     * 设置消息头部类型
     * @param $msgType
     * @return mixed
     */
    public function setMsgType($msgType)
    {
        $this->MsgType = $msgType;
        return $this->MsgType;
    }

    /**
     * 设置报文主题内容
     * @param $msgBody
     * @return mixed
     */
    public function setMsgBody($msgBody)
    {
        $this->MsgBody = $msgBody;
        return $this->MsgBody;
    }

    public function getResult()
    {
        $data = [];
        $data['Version'] = $this->Version;
        $data['MsgType'] = $this->MsgType;
        $data['MsgSeq'] = $this->MsgSeq;
        $data['TimeStamp'] = $this->TimeStamp;
        $data['PerformCode'] = $this->PerFormCode;
        $data['Skey'] = $this->getskey();
        $data['Body'] = $this->MsgBody;
        /*try {
            $this->soap->EDU($data);
        } catch (\Exception $e) {
            echo 2;
        }*/
        /*$client = new Client([
            'url' => 'http://api.ydxxt.com/services/eduSOAP?wsdl',
        ]);
        $client = $client->EDU($data);
        return $client;*/
        try {
            $client = new \SoapClient($this->wsdl);
            $result = $client->__soapCall('EDU', array($data));
        } catch (\Exception $e) {
            Yii::error("调用接口失败", 'sms');
            throw new \yii\web\HttpException(500, '与短信模块通信不应期, 请稍后再进行重试, 或跟我们客服联系!');
        }

        return $result;
    }

    public function xmlToArray($ren)
    {
        $t = get_object_vars($ren);
        if ($t['Result'] == '200') {
            $res = @simplexml_load_string($t['Body'], null, LIBXML_NOCDATA);
            $res = json_decode(json_encode($res), true);
            return $res;
        }
        return $t;
    }

    public function contentTransform()
    {

        // TODO: Implement contentTransform() method.
    }

    public function replaceSignature()
    {
        // TODO: Implement replaceSignature() method.
    }

    public function sendSMS($content)
    {
        $sms[] = ['flag' => false, 'qtPid' => '341887', 'qtSid' => '317214', 'schoolId' => '1', 'phone' => '15920344446', 'title' => '1',
                'message' => '测试', 'dateline' => '1460620036', 'type' => 'test', 'sid' => '1', 'name' => '3'];
        $sms[] = ['flag' => false, 'qtPid' => '267209', 'qtSid' => '248116', 'schoolId' => '1', 'phone' => '15920344446', 'title' => '1',
                'message' => '测试', 'dateline' => '1460620036', 'type' => 'test', 'sid' => '1', 'name' => '3'];
        $sms[] = ['flag' => false, 'qtPid' => '267209', 'qtSid' => '248116', 'schoolId' => '1', 'phone' => '15920344446', 'title' => '1',
                'message' => '测试', 'dateline' => '1460620036', 'type' => 'test', 'sid' => '1', 'name' => '3'];
        $sms[] = ['flag' => false, 'qtPid' => '267209', 'qtSid' => '248116', 'schoolId' => '1', 'phone' => '15920344446', 'title' => '1',
                'message' => '测试', 'dateline' => '1460620036', 'type' => 'test', 'sid' => '1', 'name' => '3'];

        $threadArray = [];
        foreach ($sms as $key => $threadArrayValue) {
            $threadArray[$key] = new XXTThread($threadArrayValue);
            $threadArray[$key]->start();
        }
        $threadData = [];
        foreach ($threadArray as $key => $threadArrayValue) {
            while($threadArray[$key]->isRunning())  {
                usleep(10);
            }
            if($threadArray[$key]->join()) {
                $threadData[] = $threadArray[$key]->data;
            }
        }
        $this->data = $this->objectToArray($threadData);
        return $this;
    // TODO: Implement send() method.
    }
}