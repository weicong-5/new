<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property integer $confirmed_at
 * @property string $unconfirmed_email
 * @property integer $blocked_at
 * @property string $registration_ip
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $last_login_at
 * @property integer $active
 * @property integer $is_manager
 *
 * @property Profile $profile
 * @property SocialAccount[] $socialAccounts
 * @property Token[] $tokens
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;//账号被注销
    const STATUS_ACTIVE = 1;

    const IS_USER = 0;
    const IS_MANAGER = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['username', 'email', 'password_hash', 'auth_key', 'created_at', 'updated_at'], 'required'],
//            [['confirmed_at', 'blocked_at', 'created_at', 'updated_at', 'last_login_at', 'status', 'is_manager'], 'integer'],
//            [['username', 'email', 'unconfirmed_email'], 'string', 'max' => 255],
            [['password_hash'], 'string', 'max' => 60],
            [['auth_key'], 'string', 'max' => 32],
//            [['registration_ip'], 'string', 'max' => 45],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['status'],'default','value'=>self::STATUS_ACTIVE],
            [['is_manager'],'default','value'=>self::IS_USER],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'username' => '用户名',
            'email' => '邮箱',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'confirmed_at' => 'Confirmed At',
            'unconfirmed_email' => 'Unconfirmed Email',
            'blocked_at' => 'Blocked At',
            'registration_ip' => 'Registration Ip',
            'created_at' => '生成时间',
            'updated_at' => '更新时间',
            'last_login_at' => '最后一次登录时间',
            'active' => '身份有效性',
            'is_manager' => '管理员',
            'sex'=>'性别',
            'political_status' => '政治面貌',
            'phone' => '手机号码'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasMany(Status::className(),['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocialAccounts()
    {
        return $this->hasMany(SocialAccount::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTokens()
    {
        return $this->hasMany(Token::className(), ['user_id' => 'id']);
    }

    //实现IdentityInterface 接口 必须重写的方法有以下几个：
    //根据id查找user
    public static function findIdentity($id)
    {
        return static::findOne(['id'=>$id ,'status'=>self::STATUS_ACTIVE,'is_manager'=>self::IS_USER]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('findIdentityByAccessToken is not implemented');
    }

    /**
     * Finds user by username 通过用户名找到用户
     * @param $username
     * @return static
     */
    public static function findByUserName($username){
        return static::findOne(['username' => $username,'active' => self::STATUS_ACTIVE,'is_manager' => self::IS_USER]);
    }

    /**
     * @param $username
     * @return static
     * 通过用户名找到管理员
     */
    public static function findManagerByUserName($username){
        return static::findOne(['username' => $username,'active' => self::STATUS_ACTIVE,'is_manager' => self::IS_MANAGER]);
    }

    public function getId(){
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    //验证自动登录KEY
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    //验证密码
    public function validatePassword($password){
        return Yii::$app->security->validatePassword($password,$this->password_hash);
    }

    //设置密码
    public function setPassword($password){
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    //设置自动登录KEY
    public function generateAuthKey(){
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    //DAO
    public static function queryAll($sql){
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    public static function queryOne($sql){
        return Yii::$app->db->createCommand($sql)->queryOne();
    }

    public static function queryColumn($sql){
        return Yii::$app->db->createCommand($sql)->queryColumn();
    }

}
