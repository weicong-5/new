<?php
$config = [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'getBrowser' => [
            'class' => 'common\ykocomposer\collection\BrowserCollection',
        ],
        //语言包设置
        'i18n' => [
            'translations' => [
                /*'app'=>[
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath'=>'@common/messages',
                ],*/
                '*'=> [
                    'class'         => 'yii\i18n\PhpMessageSource',
                    'basePath'      =>'@common/ykocomposer/messages',
                    'fileMap'       =>[
                        'common'    =>'common.php',
                        'backend'   =>'backend.php',
                        'frontend'  =>'frontend.php',
                        'user'      =>'user.php',
                        'school'      =>'school.php',
                        '*'         =>'common.php',
                    ],
                ],
                /* Uncomment this code to use DbMessageSource
                 '*'=> [
                    'class' => 'yii\i18n\DbMessageSource',
                    'sourceMessageTable'=>'{{%i18n_source_message}}',
                    'messageTable'=>'{{%i18n_message}}',
                    'enableCaching' => YII_ENV_DEV,
                    'cachingDuration' => 3600,
                    'on missingTranslation' => ['\backend\modules\i18n\Module', 'missingTranslation']
                ],
                */
            ],
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            //'baseUrl' => '//kami.yko.cc',
            'rules' => [
                '<id:\d+>'                               => 'profile/show',
                '<action:(login|logout)>'                => 'security/<action>',
                '<action:(register|resend)>'             => 'registration/<action>',
                'confirm/<id:\d+>/<code:[A-Za-z0-9_-]+>' => 'registration/confirm',
                'forgot'                                 => 'recovery/request',
                'recover/<id:\d+>/<code:[A-Za-z0-9_-]+>' => 'recovery/reset',
                'settings/<action:\w+>'                  => 'settings/<action>'

            ],
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'baseUrl' => '//yko.cc',
            'rules' => [
                //'settings/<action:\w+>'                  => 'settings/<action>'
            ]
        ],

    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
//            'class' => 'mdm\admin\Module',
            'controllerMap' => [
                'security' => 'backend\controllers\SecurityController'
            ],
            // you will configure your module inside this file
            // or if need different configuration for frontend and backend you may
            // configure in needed configs
        ],
    ],
    /*'as locale' => [
        'class' => 'common\ykocomposer\behaviors\LocaleBehavior',
        'enablePreferredLanguage' => true
    ],*/
    /*'as mobile' => [
        'class' => 'common\ykocomposer\behaviors\BrowserBehavior'
    ],*/
];

if (YII_DEBUG) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.1.253', '120.236.45.43'],
    ];
}
return $config;