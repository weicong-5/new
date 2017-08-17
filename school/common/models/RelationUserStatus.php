<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "relation_user_status".用户身份关系表
 *
 * @property integer $id
 * @property integer $uer_id
 * @property integer $status_id
 */
class RelationUserStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'relation_user_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uer_id', 'status_id'], 'required'],
            [['uer_id', 'status_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uer_id' => 'Uer ID',
            'status_id' => 'Status ID',
        ];
    }

    /**
     * @param $user_id
     * @return null 通过用户ID获取身份ID集合
     */
    public static function getStatusByUser($user_id){
        $status=null;
        $res = RelationUserStatus::find()->where(['user_id' => $user_id])->asArray()->all();
        if($res){//如果存在身份
            foreach($res as $k =>$list){
                $status[$list['id']] = $list['stats_id'];
            }
        }else{
            $status = null;
        }
        return $status;
    }
}
