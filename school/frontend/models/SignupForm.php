<?php
namespace frontend\models;

use common\models\Profile;
use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    //用户信息
    public $sex;
    public $phone;
    public $political_status;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '用户名已经被使用过.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => '该邮箱已经被使用过.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            [['sex','phone','political_status'],'required'],

        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        //补充的属性
        $user->status = 1;
        $user->is_manager = 0;

        if($user->save()){//往用户表插入数据的同时向用户信息表插入对应的用户信息
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->sex = $this->sex;
            $profile->phone = $this->phone;
            $profile->political_status = $this->political_status;

            return $profile->save()?$user:null;
        }else{
            return null;
        }

    }

    //补充 让标签显示中文
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('frontend','Username'),
            'password' => Yii::t('frontend','Password'),
            'email' => Yii::t('frontend','Email'),
            'sex'=>Yii::t('frontend','Sex'),
            'phone'=>Yii::t('frontend','Phone'),
            'political_status'=>Yii::t('frontend','Political status')
        ];
    }

    public static function getSexList(){
        return  array(0=>'男',1=>'女');
    }

    public static function getPoliticalList(){
        return [
            '0'=>'请选择',
            '1'=>'党员',
            '2'=>'群众',
            '3'=>'民主党派成员',
            '4'=>'无党派人士',
        ];
    }
}
