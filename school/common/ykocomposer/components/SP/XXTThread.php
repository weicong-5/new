<?php
/**
 * @Copyright Copyright (c) 2016 @XXTThread.php By Kami
 * @License http://www.yuzhai.tv/
 */

namespace common\ykocomposer\components\SP;

use common\ykocomposer\components\SP\XXT;
class XXTThread extends \Thread
{
    public $data;
    public $qtSid;
    public $qtPid;
    public $schoolId;
    public $phone;
    public $title;
    public $message;
    public $dateline;
    public $type;
    public $sid;
    public $url;
    public $name;
    public $content;
    public $flag;

    public $xxt;

    public function __construct($content)
    {
        $this->xxt = new XXT();
        $this->flag = $content['flag'];
        if ($this->flag) {
            $this->content = $content['content'];
            $this->schoolId = $content['schoolId'];
            $this->title = $content['dateline'];
            $this->type = $content['type'];
            $this->message = $content['message'];
        } else {
            $this->qtSid = $content['qtSid'];
            $this->qtPid = $content['qtPid'];
            $this->schoolId = $content['schoolId'];
            $this->phone = $content['phone'];
            $this->title = $content['title'];
            $this->message = $content['message'];
            $this->dateline = $content['dateline'];
            $this->type = $content['type'];
            $this->sid = $content['sid'];
            $this->name = $content['name'];
        }
    }

    public function run()
    {
        $xxt = $this->xxt;
        /**
         * 定时短信, 以后短信全部归类为定时短信, 因为线程只能在CLI模式下运行.
         */
        if ($this->flag) {
            $xxt->setMsgType('SEND_SINGLE_SMS');
            $xxt->setMsgBody('<MSG_BODY><CityId>cz</CityId><UserType>3</UserType><SmsType>1</SmsType><SmsList>' . $this->content . '</SmsList></MSG_BODY>');
            $result = $xxt->getResult();
            $smsSn = $xxt->xmlToArray($result);
            $status = '998';
            $this->data = ['title' => $this->title, 'message' => $this->message, 'status' => $status, 'dateline' => $this->dateline, 'schoolId' => $this->schoolId, 'type' => $this->type, 'smsSn' => $smsSn['SmsSn'], 'lastDateline' => time()];
        } else {
            $xxt->setMsgType('SEND_SINGLE_SMS');
            $xxt->setMsgBody('<MSG_BODY><CityId>cz</CityId><UserType>3</UserType><SmsType>1</SmsType><SmsList><SmsEntity><OthSmsId>20121204</OthSmsId><SmsTargetSeq>' . $this->qtPid . '</SmsTargetSeq><SmsContent>' . $this->message . '</SmsContent></SmsEntity></SmsList></MSG_BODY>');
            $result = $xxt->getResult();
            $smsSn = $xxt->xmlToArray($result);
            $this->data = (object)([
                            'name'=> $this->name, 'phone' => $this->phone, 'title' => $this->title,
                            'message' => iconv('utf-8', 'GBK', $this->message), 'status' => '201', 'dateline' => $this->dateline,
                            'schoolId' => $this->schoolId, 'type' => $this->type, 'sid' => $this->sid,
                            'qtSid' => $this->qtSid, 'qtPid' => $this->qtPid, 'smsSn' => $smsSn['SmsSn'],
                            'lastDateline' => time(), 'schoolName' => ''
                        ]);
            /*$xxt->setMsgType('QRY_SMS_RESULT');
            $xxt->setMsgBody('<MSG_BODY><CityId>cz</CityId><SmsSn>' . $smsSn['SmsSn'] . '</SmsSn><IsRead>-1</IsRead><PageNo>0</PageNo></MSG_BODY>');
            $result = $xxt->getResult();
            $status = $xxt->xmlToArray($result);
            var_dump($status);*/
            /*if ($status['LogList']['LogEntity']['SendStatus'] == '2') {
                $status = '200';
            } else {
                $status = '201';
            }

            if ($status != '200') {
                $this->data = ['name'=> $this->name, 'mobile' => $this->phone, 'title' => $this->title, 'message' => $this->message,
                    'status' => $status, 'dateline' => $this->dateline,
                    'schoolId' => $this->schoolId, 'type' => $this->type, 'sid' => $this->sid,
                    'qtSid' => $this->qtSid, 'qtPid' => $this->qtPid, 'smsSn' => $smsSn['SmsSn'],
                    'lastDateline' => time(), 'schoolName' => ''];
            } else
                $this->data = '1';*/
        }
    }
}