<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
//注册表单模型
class SignupForm extends Model
{
    //映射表单中的每个字段
    public $username;
    public $email;
    public $password;
    public $rePassword;//重复密码
    public $verifyCode;//验证码


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => \Yii::t('common','This username has already been taken.')],
            ['username', 'string', 'min' => 3, 'max' => 16],
            //规定用户名由字母、汉字、数字、下划线组成，且不能以数字和下划线开头
            ['username', 'match', 'pattern' => '/^[(\x{4e00}-\x{9fa5})a-zA-Z]+[(\x{4e00}-\x{9fa5})a-zA-Z_\d]*$/u', 'message' => \Yii::t('common','The username consists of letters,Chinese character,numbers,or underline,and can not begin with numbers and underline')],

            //unique 注册过的用户不能再注册

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => \Yii::t('common','This email address has already been taken.')],

            [['password','rePassword'] ,'required'],
            [['password','rePassword'], 'string', 'min' => 6],

            ['verifyCode','captcha'],

            //两次密码输入不一致
            ['rePassword','compare','compareAttribute'=>'password','message'=>\Yii::t('common','Two password are inconsistent')],
        ];
    }

    public function attributeLabels()//Lables
    {
        return [
            'username' => \Yii::t('common','Username'),
            'password' => \Yii::t('common','Password'),
            'email' => \Yii::t('common','Email'),
            'rePassword' => \Yii::t('common','RePassword'),
            'verifyCode' => \Yii::t('common','VerifyCode'),
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
        
        return $user->save() ? $user : null;
    }
}
