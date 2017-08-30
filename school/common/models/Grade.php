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
            'school_id' => 'School',
            'grade' => 'Grade',
            'room' => 'Room',
            'school_name' => 'School Name',
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
}
