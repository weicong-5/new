<?php

namespace backend\modules\area\models;

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
class Area extends \common\models\Area
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
}
