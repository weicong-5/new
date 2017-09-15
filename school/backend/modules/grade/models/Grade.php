<?php

namespace backend\modules\grade\models;

use backend\modules\school\models\School;
use Yii;
use common\ykocomposer\components\validators\CheckClassRoomValidator;//引入验证班级格式类

/**
 * This is the model class for table "grade".
 *
 * @property integer $id
 * @property integer $school_id
 * @property string $grade
 * @property string $room
 * @property string $school_name
 */
class Grade extends \common\models\Grade
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['school_id', 'grade', 'room', 'school_name'], 'required'],
            [['school_id'], 'integer'],
            [['grade', 'room', 'school_name'], 'string', 'max' => 255],
            ['room',CheckClassRoomValidator::className()],
            //组合唯一规则
            [['room'],'unique','targetAttribute'=>['school_name','grade','room'],'message'=>'该班级已经存在']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'school_id' => 'School ID',
            'grade' => Yii::t('school','Grade'),
            'room' => Yii::t('school','Room'),
            'school_name' => Yii::t('school','School Name'),
        ];
    }

    /**
     * 获取所有年级
     */
    public static function getAllGrades(){
        $list = [
            '1' => '一年级',
            '2' => '二年级',
            '3' => '三年级',
            '4' => '四年级',
            '5' => '五年级',
            '6' => '六年级',
            '7' => '初一',
            '8' => '初二',
            '9' => '初三',
            '10' => '高一',
            '11' => '高二',
            '12' => '高三',
        ];
        return array_merge(array(0=>'请选择'),$list);
    }

    /**
     * @param $item
     * @return mixed
     * 根据年级得到索引ID
     */
    public static function getIndex($item){
        return array_search($item,self::getAllGrades());
    }

    public function getSchool(){
        return $this->hasOne(School::className(),['id'=>'school_id']);
    }
}
