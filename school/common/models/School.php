<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "school".
 *
 * @property integer $id
 * @property integer $area_id
 * @property string $school_name
 * @property string $address
 * @property string $district
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
            [['area_id', 'school_name', 'address', 'district'], 'required'],
            [['area_id'], 'integer'],
            [['school_name', 'address', 'district'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'area_id' => 'Area ID',
            'school_name' => 'School Name',
            'address' => 'Address',
            'district' => 'District',
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
