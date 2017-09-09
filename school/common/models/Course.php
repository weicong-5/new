<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "course".
 *
 * @property integer $id
 * @property integer $school_id
 * @property string $grade
 * @property string $course
 * @property string $school_name
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['school_id', 'grade', 'school_name'], 'required'],
            [['school_id'], 'integer'],
            [['course'], 'string'],
            [['grade', 'school_name'], 'string', 'max' => 255],
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
            'grade' => 'Grade',
            'course' => '课程',
            'school_name' => 'School Name',
        ];
    }

    //获取所有预设好的课程
    public static function getAllCourse(){
        return array(
            0=>'请选择',
            1=>'语文',
            2=>'数学',
            3=>'英语',
            4=>'政治',
            5=>'历史',
            6=>'地理',
            7=>'物理',
            8=>'化学',
            9=>'生物',
            10=>'体育',
            11=>'计算机',
            12=>'科学与自然',
            13=>'思想品德'
        );
    }
}
