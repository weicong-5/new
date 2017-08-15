<?php

namespace backend\modules\school\models;

use dektrium\user\models\User;
use Yii;

/**
 * This is the model class for table "school_school".
 *
 * @property integer $id
 * @property string $name
 * @property integer $province_id
 * @property integer $city_id
 * @property integer $area_id
 * @property string $address
 * @property string $school_type
 * @property string $school_num
 * @property integer $manage_uid
 * @property integer $quantong_id
 * @property string $number
 * @property string $deny_code
 *
 * @property SchoolDistrict $province
 */
class School extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'school_school';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['province_id', 'city_id', 'area_id', 'manage_uid', 'quantong_id'], 'integer'],
            [['number', 'deny_code', 'province_id', 'city_id', 'area_id', 'manage_uid', 'quantong_id', 'name', 'school_num', 'school_type'], 'required'],
            [['number', 'deny_code'], 'string'],
            [['name', 'address', 'school_num'], 'string', 'max' => 255],
            //[['province_id', 'city_id', 'area_id'], 'exist', 'skipOnError' => true, 'targetClass' => SchoolDistrict::className(), 'targetAttribute' => ['province_id' => 'id']],
            [['manage_uid'], 'exist', 'targetClass' => User::className(), 'targetAttribute' => ['manage_uid' => 'id']],
            [['school_num', 'area_id'], 'unique', 'targetAttribute' => ['school_num', 'area_id']],
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
            'province_id' => Yii::t('school', 'Province ID'),
            'city_id' => Yii::t('school', 'City ID'),
            'area_id' => Yii::t('school', 'Area ID'),
            'address' => Yii::t('school', 'Address'),
            'school_type' => Yii::t('school', 'School Type'),
            'school_num' => Yii::t('school', 'School Num'),
            'manage_uid' => Yii::t('school', 'Manage Uid'),
            'quantong_id' => Yii::t('school', 'Quantong ID'),
            'number' => Yii::t('school', 'Number'),
            'deny_code' => Yii::t('school', 'Deny Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(SchoolDistrict::className(), ['id' => 'province_id'])->inverseOf('schools');
    }

    /**
     * @inheritdoc
     * @return \backend\modules\school\models\query\SchoolQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\school\models\query\SchoolQuery(get_called_class());
    }

    /**
     * The parameters ($deny_code, $number) passed to serialize, $school_num comma to be processed.
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->deny_code = $this->fieldsSerialize($this->deny_code);
            $this->number = $this->fieldsSerialize($this->number);
            $this->school_type = implode(',', $this->school_type);
            return true;
        } else {
            return false;
        }
    }

    public function fieldsSerialize($field, $explode1 = '|', $explode2 = ':')
    {
        //$number = [];
        $field = explode($explode1, $field);
        if (is_array($field)) {
            foreach ($field as $value) {
                $number[] = explode($explode2, $value);
            }
            return serialize($number);
        } else {
            return $field;
        }
    }

    public static function fieldUnSerialize($field)
    {
        $field = unserialize($field);
        $returnField = '';
        foreach ($field as $value) {
            $returnField .= $value[0].':'.$value[1].'|';
        }
        return substr($returnField, 0, strlen($returnField) - 1);
    }

    public static function schoolType($type)
    {
        $operators = array(
            Yii::t('school', 'Primary school') => 1,
            Yii::t('school', 'Junior high school') => 2,
            Yii::t('school', 'Senior middle school') => 3,
            Yii::t('school', 'Preschool') => 0,
        );
        $result = '| ';
        foreach ($type as $value) {
            $result .= array_search($value, $operators)." | ";
        }
        return $result;
    }
}
