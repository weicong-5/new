<?php

namespace backend\modules\school\models;

use backend\modules\grade\models\Grade;
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
class School extends \common\models\School
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
            //组合唯一规则
            [['school_name','district'],'unique','targetAttribute'=>['school_name','district'],'message'=>'该学校已经存在']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'area_id' => Yii::t('school','Area ID'),
            'school_name' => Yii::t('school','School Name'),
            'address' => Yii::t('school','Address'),
            'district' => Yii::t('school','District'),
        ];
    }

    public function getGrades(){
        return $this->hasMany(Grade::className(),['school_id'=>'id']);
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
         return  array_merge(array('0'=>'请选择'),$result);
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
