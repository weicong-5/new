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
 * @property integer $sex
 * @property string $grade
 * @property string $class_name
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
            [['user_id', 'student_no', 'school_id','sex', 'accommodate'], 'integer'],
            [['school_name', 'student_name', 'grade', 'class_name'], 'string', 'max' => 255],
        ];
    }

    public function getPositions(){
        return $this->hasMany(StudentPosition::className(),['student_id'=>'id'])->asArray();
    }


}
