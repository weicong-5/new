<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "student". 学生身份表
 *
 * @property integer $id
 * @property string $student_num
 * @property string $name
 * @property integer $sex
 * @property string $birth
 * @property integer $school_id
 * @property integer $grade_id
 * @property integer $class_id
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_num', 'name', 'sex', 'birth', 'school_id', 'grade_id', 'class_id'], 'required'],
            [['sex', 'school_id', 'grade_id', 'class_id'], 'integer'],
            [['student_num'], 'string', 'max' => 256],
            [['name', 'birth'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_num' => 'Student Num',
            'name' => 'Name',
            'sex' => 'Sex',
            'birth' => 'Birth',
            'school_id' => 'School ID',
            'grade_id' => 'Grade ID',
            'class_id' => 'Class ID',
        ];
    }
}
