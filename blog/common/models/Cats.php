<?php

namespace common\models;

use common\models\base\Base;
use Yii;

/**
 * This is the model class for table "cats".
 *
 * @property integer $id
 * @property string $cat_name
 */
class Cats extends Base
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cats';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cat_name' => Yii::t('app', 'Cat Name'),
        ];
    }

    //获取所有分类
    public static function getAllCats(){
        $cats = ['0'=> '暂无分类'];//id 永远不可能是0
        $res = self::find()->asArray()->all();
//        print_r($res);
//        exit();
        if($res){
            foreach($res as $k => $list){
                $cats[$list['id']] =$list['cat_name'];
            }
        }
//        print_r($cats);
        return $cats;
    }
}
