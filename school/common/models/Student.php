<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property integer $id
 * @property string $student_num
 * @property string $name
 * @property integer $sex
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
            [['student_num', 'name', 'sex', 'school_id', 'grade_id', 'class_id'], 'required'],
            [['sex', 'school_id', 'grade_id', 'class_id'], 'integer'],
            [['student_num'], 'string', 'max' => 256],
            [['name'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_num' => '学号',
            'name' => '姓名',
            'sex' => '性别',
            'school_id' => '学校',
            'grade_id' => '年级',
            'class_id' => '班级',
        ];
    }

    /**
     * 根据id获取学生表中的name字段属性
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
