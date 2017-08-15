<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        /*'authManager' => [
            'class' => 'yii\rbac\DbManager',//补充该代码后 重新打开终端执行php yii migrate --migrationPath=@yii/rbac/migrations 建立相应的数据表
        ],*///添加表之后即可注释或删掉该代码
        'sms' => [
            'class' => 'common\ykocomposer\components\Sms',
            'defaultSP' => 'XXT',
            'SP' =>  [
                'XXT'=> [
                ],
            ],
        ],
    ],
    'params' => $params,
];
