<?php
/**
 * @Copyright Copyright (c) 2016 @Token.php By Kami
 * @License http://www.yuzhai.tv/
 */

namespace common\ykocomposer\models\user;

use Yii;
use dektrium\user\models\Token as dektriumToken;
use yii\db\ActiveRecord;
class Token extends dektriumToken
{
    public function beforeSave($insert)
    {
        if ($insert) {
            static::deleteAll(['user_id' => $this->user_id, 'type' => $this->type]);
            $this->setAttribute('created_at', time());
            //$this->setAttribute('code', Yii::$app->security->generateRandomString());
            $this->setAttributes('code', $this->code);
        }
        return ActiveRecord::beforeSave($insert);
    }

    public function getUserByUerId($userId)
    {
        return static::findOne(['user_id' => $userId]);
    }
}