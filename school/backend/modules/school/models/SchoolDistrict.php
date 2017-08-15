<?php

namespace backend\modules\school\models;

use Yii;

/**
 * This is the model class for table "school_district".
 *
 * @property integer $id
 * @property string $name
 * @property integer $level
 * @property integer $upid
 * @property integer $displayorder
 *
 * @property SchoolSchool[] $schoolSchools
 */
class SchoolDistrict extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'school_district';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['level', 'upid', 'displayorder'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'level' => Yii::t('school', 'Level'),
            'upid' => Yii::t('school', 'Upid'),
            'displayorder' => Yii::t('school', 'Displayorder'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchoolSchools()
    {
        return $this->hasMany(SchoolSchool::className(), ['province_id' => 'id'])->inverseOf('province');
    }

    public function setCache($level)
    {
        $list = self::find()->where(['level' => $level])->all();
        return $list;
    }

    /**
     * Extraction provinces array according to a cache file
     * @return array|null
     */
    public static function getProvince()
    {
        return Yii::$app->cache->get('provinceCache');
    }

    public static function getCity($provinceId)
    {
        return isset(Yii::$app->cache->get('cityCache')[$provinceId]) ? Yii::$app->cache->get('cityCache')[$provinceId] : [];
    }

    public static function getArea($cityId)
    {
        return isset(Yii::$app->cache->get('areaCache')[$cityId]) ? Yii::$app->cache->get('areaCache')[$cityId] : [];
    }
}
