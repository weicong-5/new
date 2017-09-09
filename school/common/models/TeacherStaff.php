<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "teacher_staff".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $staff_type
 * @property string $name
 * @property integer $sex
 * @property string $political_status
 * @property string $tel
 * @property integer $school_id
 * @property string $school_name
 * @property string $office_room
 * @property string $office_phone
 * @property string $headteacher_grade
 * @property string $headteacher_class
 * @property string $subject
 * @property string $teach_grade
 * @property string $teach_class
 */
class TeacherStaff extends \yii\db\ActiveRecord
{

    /**
     * 获取所有的教师职工身份类型
     * @return array
     */
    public static function getAllStaffType(){
        return [
            '1'=>'校长',
            '2'=>'班主任',
            '3'=>'科任老师',
        ];
    }

    /**
     * 获取所有的政治面貌
     * @return array
     */
    public static function getAllPoliticalStatus(){
        return [
            '1'=>'党员',
            '2'=>'群众',
            '3'=>'民主党派成员',
            '4'=>'无党派人士',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teacher_staff';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'staff_type', 'name', 'tel', 'school_id', 'school_name'], 'required'],
//            [['name','staff_type','school_name'],'unique'],
            ['name','unique','targetClass'=>'\common\models\TeacherStaff','message'=>'该角色已经存在'],
            [['user_id', 'sex', 'school_id'], 'integer'],
            [['staff_type', 'name', 'political_status', 'school_name', 'office_room', 'headteacher_grade', 'headteacher_class', 'subject', 'teach_class'], 'string', 'max' => 255],
            [['tel', 'office_phone'], 'string', 'max' => 11],
            [['teach_grade'], 'string', 'max' => 6],
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
            'staff_type' => '职工类型',
            'name' => '姓名',
            'sex' => '性别',
            'political_status' => '政治面貌',
            'tel' => '手机号码',
            'school_id' => 'School ID',
            'school_name' => '学校',
            'office_room' => '办公室',
            'office_phone' => '办公电话',
            'headteacher_grade' => '任班主任所在年级',
            'headteacher_class' => '任班主任所在班级',
            'subject' => '所教科目',
            'teach_grade' => '所教年级',
            'teach_class' => '所教班级',
        ];
    }

    public static function getStaffTypeIndex($staff,$arr){
        return array_search($staff,$arr);
    }

    public static function getPoliticalIndex($status,$arr){
        return array_search($status,$arr);
    }
}
