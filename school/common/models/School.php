<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "school".
 *
 * @property integer $id
 * @property string $school_name
 * @property string $address
 * @property string $tel
 * @property integer $student_count
 * @property integer $teacher_count
 */
class School extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'school';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['school_name', 'student_count', 'teacher_count'], 'required'],
            [['student_count', 'teacher_count'], 'integer'],
            [['school_name', 'address'], 'string', 'max' => 255],
            [['tel'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'school_name' => 'School Name',
            'address' => 'Address',
            'tel' => 'Tel',
            'student_count' => 'Student Count',
            'teacher_count' => 'Teacher Count',
        ];
    }

    /**
     * 获取所有学校
     * @return null
     */
    public static function getAllSchool(){
        $result = null;
        $res = School::find()->asArray()->all();
        if($res){
            foreach($res as $list){
                $result[$list['id']] = $list['school_name'];
            }
        }
        return $result;
    }

    public static function getSchoolNameById($id){
        $res = School::find()->where(['id'=>$id])->asArray()->one();
        if($res){
            return $res['school_name'];
        }else{
            return null;
        }
    }
}
