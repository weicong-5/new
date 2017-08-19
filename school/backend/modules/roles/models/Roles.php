<?php

namespace backend\Modules\roles\models;

use common\models\Student;
use Yii;
use yii\rbac\Role;

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

    /**
     * 获取所有角色分类
     * @return null
     */
    public static  function getAllRoles(){
        $roles=null;
        $res =self::find()->asArray()->all();
        if($res){
            foreach($res as $k => $list){
                $roles[$list['id']] = $list['rolename'];
            }
        }
        return $roles;
    }

    /**
     * 根据id获取角色名称
     * @param $id
     * @return mixed
     */
    public static function getRoleNameById($id){
        $res = Roles::find()->where(['id'=>$id])->asArray()->one();
        return $res['rolename'];
    }

    public static function switchRole($id){
        $role = null;
        switch($id){
            case 1:
                $role = new Student();
                break;
            case 2:
                //教师职工
                break;
            default:
                break;
        }
        return $role;
    }
}
