<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'user' => [
            // following line will restrict access to admin controller from frontend application
            //从前端限制对admin控制器的访问
            'as frontend' => 'dektrium\user\filters\FrontendFilter',
        ],
    ],
    'components' => [
        //原有注释
//        'user' => [
//            'identityClass' => 'common\models\User',
//            'enableAutoLogin' => true,
//            //把下面的配置 包含进来
//            'identityCookie' => [
//                'name' => '_frontendIdentity',
//                'httpOnly' => true,
//            ],
//        ],
        //设置在一个域中独立对话
        'user' => [
            'identityCookie' => [
                'name'     => '_frontendIdentity',
                'path'     => '/',
                'httpOnly' => true,
            ],
        ],
        'session' => [
            'name' => 'FRONTENDSESSID',
            'cookieParams' => [
                'httpOnly' => true,
                'path'     => '/',
            ],
        ],
        //定义session 名字
        'session' => [
            'name' => 'school-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['sms'],
                    'logFile' => '@console/runtime/logs/sms_' . date('Y-m-d', time()) . '.log',
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        //url美化
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
//            'rules' => [
//            ],
        ],

        'sms' => [
            'class' => 'common\ykocomposer\components\Sms',
            'defaultSP' => 'XXT',
            'SP' =>  [
                'XXT'=> [
                ],
            ],
        ]
    ],
    'as locale' => [
        'class' => 'common\ykocomposer\behaviors\LocaleBehavior',
        'enablePreferredLanguage' => true
    ],
//    尝试补充
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
//            '*',
        ],
    ],
    'params' => $params,
];
