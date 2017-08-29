<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "area".
 *
 * @property integer $id
 * @property string $province_name
 * @property string $city_name
 * @property string $area_name
 * @property string $postcode
 */
class Area extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['province_name', 'city_name', 'area_name'], 'required'],
            [['province_name', 'city_name', 'area_name', 'postcode'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'province_name' => 'Province Name',
            'city_name' => 'City Name',
            'area_name' => 'Area Name',
            'postcode' => 'Postcode',
        ];
    }

    /**
     * @return array|\yii\db\ActiveRecord[] 数组形式获取所有地区
     */
    public static function getAll(){
        $areas = ['0' => '请选择地区'];
        $res = self::find()->asArray()->all();
        if($res){
            foreach($res as $k => $list){
                $areas[$list['id']]=$list['province_name'].'-'.$list['city_name'].'-'.$list['area_name'];
            }
        }else{
            $areas = ['0' => '暂无数据'];
        }
        return $areas;
    }
}
