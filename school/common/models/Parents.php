<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "parents".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $student_id
 * @property string $parent_name
 * @property string $tel
 */
class Parents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'student_id', 'parent_name'], 'required'],
            [['user_id', 'student_id'], 'integer'],
            [['parent_name'], 'string', 'max' => 255],
            [['tel'], 'string', 'max' => 11],
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
            'student_id' => 'Student ID',
            'parent_name' => 'Parent Name',
            'tel' => 'Tel',
        ];
    }
}
