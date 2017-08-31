<?php

namespace common\models;

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
 * @property integer $course_id
 * @property integer $score_id
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
            [['user_id', 'student_no', 'school_id', 'school_name', 'student_name', 'grade', 'class_name'], 'required'],
            [['user_id', 'student_no', 'school_id', 'course_id', 'score_id'], 'integer'],
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
            'student_no' => '学号',
            'school_id' => 'School ID',
            'school_name' => 'School Name',
            'student_name' => '姓名',
            'sex' => 'Sex',
            'grade' => 'Grade',
            'class_name' => '班级',
            'class_position' => '班内职务',
            'course_id' => 'Course ID',
            'score_id' => 'Score ID',
        ];
    }

    /**
     * 根据id获取学生表中的某个字段属性
     * @param $name
     * @param $id
     * @return mixed|null
     */
    public static function getAttributeById($name,$id){
        $res = Student::find()->where(['id'=>$id])->asArray()->one();
        if($res){
            return $res[$name];
        }else{
            return null;
        }
    }
}
