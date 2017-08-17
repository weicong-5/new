<?php
/**
 * Created by PhpStorm.
 * User: RedSun
 * Date: 2017/8/17
 * Time: 11:50
 */
namespace backend\Modules\roles\models;

use yii\base\Model;

class RoleForm extends Model{
    //声明属性
    public $id;

    public function rules(){
        return [
            ['id','integer'],
        ];
    }

    public function attributeLabels()
    {
       return [
           'id' => 'ID',
       ];
    }
}