<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $status
 * @property string $name
 * @property string $school
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'status', 'name'], 'required'],
            [['user_id'], 'integer'],
            [['status', 'name', 'school'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'status' => '身份',
            'name' => '姓名',
            'school' => '学校',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser(){
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }

    /**
     * @param $user_id
     * @return null 通过用户ID获取身份ID集合
     */
    public static function getStatusByUser($user_id){
        $status=null;
        $res = Status::find()->where(['user_id' => $user_id])->asArray()->all();
        if($res){//如果存在身份
            return $res;
        }else{
            return $status;
        }
    }

    /**
     * 获取身份的下拉框中的数组值
     */
    public static function getStatusList(){
        return [
            'none'=>'--选择身份--',
            'student'=>'学生',
            'parent'=>'家长',
            'teacher-staff'=>'教师职工'
        ];
    }

    /**
     * 判断身份是否存在
     */
    public static function isStatusExist(){

    }
}
