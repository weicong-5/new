<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/9/14
 * Time: 14:39
 */
namespace common\ykocomposer\components\validators;

use yii\validators\Validator;

class CheckClassRoomValidator extends Validator{
    public function validateAttribute($model, $attribute)
    {
        if(preg_match('/[1-9]\d*班/',$model->$attribute) == 0){
            $this->addError($model,$attribute,'班级格式错误（格式模板：1班）,请重新输入');
        }else{
            return true;
        }
    }
}