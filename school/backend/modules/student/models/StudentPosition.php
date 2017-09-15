<?php

namespace backend\modules\student\models;

use Yii;

/**
 * This is the model class for table "student_position".
 *
 * @property integer $id
 * @property integer $student_id
 * @property string $position
 */
class StudentPosition extends \common\models\StudentPosition
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_position';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'position'], 'required'],
            [['student_id'], 'integer'],
            [['position'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'position' => 'Position',
        ];
    }

    public function getStudent(){
        return $this->hasOne(Student::className(),['id'=>'student_id']);
    }
}
