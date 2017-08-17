<?php

namespace backend\Modules\roles\models;

use Yii;

/**
 * This is the model class for table "roles".
 *
 * @property integer $id
 * @property string $rolename
 */
class Roles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rolename'], 'required'],
            [['rolename'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rolename' => '角色名称',
        ];
    }

    //获取所有主角分类
    public static  function getAllRoles(){
//        $roles = ['0' => '--请选择--'];
        $roles=null;
        $res =self::find()->asArray()->all();
        if($res){
            foreach($res as $k => $list){
//                $roles[$role['id']] = $role['rolename'];
//                $roles[$k] = $role['rolename'];
                $roles[$list['id']] = $list['rolename'];
            }
        }
        return $roles;
    }
}
