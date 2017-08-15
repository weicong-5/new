<?php
/**
 * @Copyright Copyright (c) 2016 @BaseSms.php By Kami
 * @License http://www.yuzhai.tv/
 */

namespace common\ykocomposer\components;

use yii\base\Component;

abstract class BaseSms extends Component
{
    public $lastErrorMessage;
    public $returnMessage;

    //abstract public function initialize();

    abstract public function contentTransform();

    abstract public function replaceSignature();

    abstract public function sendSMS($content);

    public function arrayChunkVertical($list = [], $columns = 45)
    {
        if (!is_array($list)) {
            throw new \yii\web\HttpException(500, '错误的传递参数$list');
        }

        $num = count($list);
        $perColumn = floor($num / $columns);
        $rest = $num % $columns;

        $perColumn = [];
        for ($i = 0; $i < $columns; $i++) {
            $perColumn[$i] = $perColumn + ($i < $rest ? 1: 0);
        }

        $tabular = [];
        foreach ($perColumn as $rows) {
            for ($i = 0; $i < $rows; $i++) {
                $tabular[$i][] = array_shift($list);
            }
        }

        return $tabular;
    }

    function objectToArray($d)
    {
        if (is_object($d)) {
            $d = get_object_vars($d);
        }

        if (is_array($d)) {
            return array_map(array($this, __FUNCTION__), $d);
        }
        else {
            return $d;
        }
    }

    function arrayToObject($d)
    {
        if (is_array($d)) {
            return (object) array_map(array($this, __FUNCTION__), $d);
        }
        else {
            return $d;
        }
    }
}