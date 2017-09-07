<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "score".
 *
 * @property integer $id
 * @property integer $student_id
 * @property string $score
 * @property string $subject
 * @property string $comment
 * @property string $school
 * @property string $grade
 * @property string $class
 */
class Score extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'score';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'score', 'subject', 'comment', 'school', 'grade', 'class'], 'required'],
            [['student_id'], 'integer'],
            [['score', 'class'], 'string', 'max' => 4],
            [['subject'], 'string', 'max' => 20],
            [['comment'], 'string', 'max' => 255],
            [['school'], 'string', 'max' => 225],
            [['grade'], 'string', 'max' => 6],
            [['score'],'compare','compareValue'=>130,'operator'=>'<=','message'=>'成绩是无效的，只能在0~130范围内']
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
            'score' => '成绩',
            'subject' => '科目',
            'comment' => '备注（如第几次单元考，期中或期末）',
            'school' => '学校',
            'grade' => '年级',
            'class' => '班级',
        ];
    }
}
