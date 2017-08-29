<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$config = [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
        ],
//        'user' => [
//            // following line will restrict access to admin page
//            'as backend' => 'dektrium\user\filters\BackendFilter',
//            'admins' => ['kami'],
//        ],
        'school' => [
            'class' => 'backend\modules\school\school',
        ],
        //新增的
        'role' => [
            'class' => 'backend\modules\roles\role'
        ],
//        'user' => [
//            'class' => 'backend\modules\user\user',
////            'identityClass' => 'backend\modules\user\models\User',
//        ]

    ],
    'components' => [
//        'user' => [
//            'class'=>'yii\web\User',
//            'identityClass' => 'common\models\User',
//            'enableAutoLogin' => true,
//        ],
//        'user' => [
//            'identityCookie' => [
//                'name'     => '_backendIdentity',
//                'path'     => '/admin',
//                'httpOnly' => true,
//            ],
//        ],
//        'session' => [
//            'name' => 'BACKENDSESSID',
//            'cookieParams' => [
//                'httpOnly' => true,
//                'path'     => '/admin',
//            ],
//        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */

        //对227数据进行转移
        'db2' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=183.234.110.227;dbname=ultrax', //maybe other dbms such as psql,...
            'username' => 'dashi',
            'password' => 'CdaShi',
            'charset' => 'utf8',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',//使用数据库管理配置文件
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            /*'site/*',//允许访问的节点，可自行添加
            'admin/*',//允许所有人访问admin节点及其子节点*/
            '*',//允许所有人访问admin节点及其子节点
        ]
    ],
    'as locale' => [
        'class' => 'common\ykocomposer\behaviors\LocaleBehavior',
        'enablePreferredLanguage' => true
    ],
    //给yii2-admin 插件起了个简短的别名
    'aliases'=>[
        '@mdm/admin' => '@vendor/mdmsoft/yii2-admin',
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.1.253', '120.236.45.43'],
    ];
}
return $config;


