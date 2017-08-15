<?php
/**
 * @Copyright Copyright (c) 2016 @ActivationForm.php By Kami
 * @License http://www.yuzhai.tv/
 */

namespace frontend\models;

use dektrium\user\Finder;
use common\ykocomposer\models\user\Token;
use Yii;
use yii\base\Model;

/**
 * ActivationForm gets user mobile phone and validates if user has already confirmed his account. If so, it shows error
 * message, otherwise it generates and sends new confirmation token to user.
 * @property \dektrium\user\Module $module
 * @property User $user
 *
 * @author Kami <yesela@163.com>
 */
class ActivationForm extends Model
{
    /** @var string */
    public $phone;

    /** @var string */
    public $code;

    /** @var string */
    public $password;

    /** @var \dektrium\user\models\User */
    private $_user;

    /** @var \dektrium\user\Module */
    protected $module;

    /** @var Finder */
    protected $finder;

    /**
     * @param Finder $finder
     * @param array  $config
     */
    public function __construct(Finder $finder, $config = [])
    {
        $this->module = Yii::$app->getModule('user');
        $this->finder = $finder;
        parent::__construct($config);
    }

    /**
     * @return User
     */
    public function getUser()
    {
        if ($this->_user === null) {
            $this->_user = $this->finder->findUser(['phone' => $this->phone])->one();
        }

        return $this->_user;
    }

    /** @inheritdoc */
    public function scenarios()
    {
        return [
            'sendLoginCode' => ['phone'],
            'index' => ['code', 'phone', 'password'],
        ];
    }

    /** @inheritdoc */
    public function rules()
    {
        return [
            'phoneRequired'     => ['phone', 'required'],
            'phoneTrim'         => ['phone', 'filter', 'filter' => 'trim'],
            'phonePattern'      => ['phone', 'match', 'pattern'=>'/^1[0-9]{10}$/', 'message' => Yii::t('common', 'Phone numbers must be 11 digits')],
            'phoneInteger'      => ['phone', 'integer'],
            'phoneExist'        => ['phone', 'exist', 'targetClass' => $this->module->modelMap['User']],
            'phoneConfirmed'    => [
                'phone',
                function ($attribute) {
                    if ($this->user != null && $this->user->getIsConfirmed()) {
                        $this->addError($attribute, Yii::t('user', 'This account has already been confirmed'));
                    }
                }
            ],

            'captchaRequired'   => ['code', 'required'],
            'captchaTrim'       => ['code', 'filter', 'filter' => 'trim'],
            'captchaInteger'    => ['code', 'integer'],
            'captchaLength'     => ['code', 'string', 'min'=>6, 'max' => 6],
            //'captchaExist'      => ['code', 'exist', 'targetClass' => '\dektrium\user\models\Token'],
            'captchaExist'      => ['code', 'validateCode'],

            'passwordRequired'  => ['password', 'required', 'skipOnEmpty' => false],
            'passwordLength'    => ['password', 'string', 'min' => '6'],
        ];
    }

    /** @inheritdoc */
    public function validateCode($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $userId = $this->user->id;
            $code = new Token();
            $code = $code->getUserByUerId($userId)['code'];
            if (!$userId || !$code) {
                $this->addError($attribute, Yii::t('common', 'Please enter the correct phone number, click Get validation code before proceeding'));
            }
        }
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'phone'     => Yii::t('common', 'Phone'),
            'code'   => Yii::t('common', 'Captcha'),
            'password'   => Yii::t('common', 'Password'),
        ];
    }

    /** @inheritdoc */
    public function formName()
    {
        return 'resend-form';
    }

    /**
     * Creates new confirmation token and sends it to the user.
     *
     * @return bool
     */
    public function resend()
    {

        if (!$this->validate()) {
            return false;
        }

        $token = Yii::createObject([
            'class'   => Token::className(),
            'user_id' => $this->user->id,
            'type'    => Token::TYPE_RECOVERY,
            'code'    => 222222,
        ]);

        $token->save(false);
        Yii::$app->session->setFlash('info', Yii::t('user', 'A message has been sent to your email address. It contains a confirmation link that you must click to complete registration.'));

        return true;
    }

    /**
     * Resets user's password.
     *
     * @param \dektrium\user\models\Token $token
     *
     * @return bool
     */
    public function resetPassword(\dektrium\user\models\Token $token)
    {

        if (!$this->validate() || $token->user === null) {
            return false;
        }

        if ($token->user->resetPassword($this->password)) {
            Yii::$app->session->setFlash('success', Yii::t('user', 'Your password has been changed successfully.'));
            $token->delete();
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('user', 'An error occurred and your password has not been changed. Please try again later.'));
        }

        return true;
    }
}