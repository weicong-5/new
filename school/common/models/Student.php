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
 * @property integer $accommodate
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
            ['student_no','unique','targetClass'=>'\common\models\Student','message'=>'该学号已经存在'],
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
            'student_no' => '学号',
            'school_id' => 'School ID',
            'school_name' => '学校',
            'student_name' => '姓名',
            'sex' => '性别',
            'grade' => '年级',
            'class_name' => '班级',
            'class_position' => '班内职务',
            'accommodate' => '住宿',
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

    public static function getSexIndex($sex){
        return array_search($sex,array(0=>'男',1=>'女'));
    }

    public static function getSchoolIndex($item,$arr){
        return array_search($item,$arr);
    }
}
