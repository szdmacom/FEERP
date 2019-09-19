<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'authManager' => [
            'class' => 'wind\rest\components\DbManager', //配置文件
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
