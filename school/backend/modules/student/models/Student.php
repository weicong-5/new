<?php

namespace backend\modules\student\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $student_no
 * @property integer $school_id
 * @property string $school_name
 * @property string $student_name
 * @property string $sex
 * @property string $grade
 * @property string $class_name
 * @property string $class_position
 * @property integer $accommodate
 */
class Student extends \common\models\Student
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
            [['user_id', 'student_no', 'school_id', 'school_name', 'student_name', 'grade', 'class_name'], 'required'],
            [['user_id', 'student_no', 'school_id', 'accommodate'], 'integer'],
            [['school_name', 'student_name', 'grade', 'class_name', 'class_position'], 'string', 'max' => 255],
            [['sex'], 'string', 'max' => 8],
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
            'student_no' => 'Student No',
            'school_id' => 'School ID',
            'school_name' => 'School Name',
            'student_name' => 'Student Name',
            'sex' => 'Sex',
            'grade' => 'Grade',
            'class_name' => 'Class Name',
            'class_position' => 'Class Position',
            'accommodate' => 'Accommodate',
        ];
    }
}
