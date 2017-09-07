<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "grade".  班级表
 *
 * @property integer $id
 * @property integer $school_id
 * @property string $grade
 * @property string $room
 * @property string $school_name
 */
class Grade extends \yii\db\ActiveRecord
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'school_id' => '学校',
            'grade' => '年级',
            'room' => '班级',
            'school_name' => '学校',
        ];
    }

    /**
     * 获取所有年级
     */
    public static function getAllGrades(){
        return [
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
    }

    /**
     * @param $item
     * @return mixed
     * 根据年级得到索引ID
     */
    public static function getIndex($item){
        return array_search($item,self::getAllGrades());
    }
}
