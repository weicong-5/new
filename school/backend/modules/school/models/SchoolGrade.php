<?php

namespace backend\modules\school\models;

use Yii;

/**
 * This is the model class for table "school_grade".
 *
 * @property integer $id
 * @property string $name
 * @property integer $school_area_id
 * @property integer $school_id
 * @property integer $dateline
 * @property integer $display_order
 *
 * @property School $school
 */
class SchoolGrade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'school_grade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'allInteger'    => [['school_area_id', 'school_id', 'dateline', 'display_order'], 'integer'],
            'nameMax'       => [['name'], 'string', 'max' => 255],
            'allRequired'   => [['school_id', 'name', ], 'required'],
            'schoolIdExist' => [['school_id'], 'exist', 'skipOnError' => true, 'targetClass' => School::className(), 'targetAttribute' => ['school_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('school', 'ID'),
            'name' => Yii::t('school', 'Name'),
            'school_area_id' => Yii::t('school', 'School Area ID'),
            'school_id' => Yii::t('school', 'School ID'),
            'dateline' => Yii::t('school', 'Dateline'),
            'display_order' => Yii::t('school', 'Display Order'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchool()
    {
        return $this->hasOne(School::className(), ['id' => 'school_id']);
    }

    /**
     * @inheritdoc
     * @return \backend\modules\school\models\query\SchoolGradeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\school\models\query\SchoolGradeQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $schoolAreaId = $this->school->area_id;
            $this->school_area_id = $schoolAreaId;
            $this->setAttribute('dateline', time());
            return true;
        } else {
            return false;
        }
    }
}
