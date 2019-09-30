<?php
$params = array_merge(
    require __DIR__.'/../../common/config/params.php',
    require __DIR__.'/../../common/config/params-local.php',
    require __DIR__.'/params.php',
    require __DIR__.'/params-local.php'
);

return [
    'id'                  => 'app-api',
    'basePath'            => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap'           => ['log'],
    'modules'             => [
        'rbac'   => [
            'class' => 'wind\rest\modules',
        ],
        'oauth2' => [
            'class'               => 'filsh\yii2\oauth2server\Module',
            'tokenParamName'      => 'access_token',
            'tokenAccessLifetime' => 3600 * 24,
            'storageMap'          => [
                'user_credentials' => 'api\models\User',
            ],
            'grantTypes'          => [
                'user_credentials'   => [
                    'class' => 'OAuth2\GrantType\UserCredentials',
                ],
                'client_credentials' => [
                    'class' => 'OAuth2\GrantType\ClientCredentials',
                ],
                'refresh_token'      => [
                    'class' => 'OAuth2\GrantType\RefreshToken',
//                    'always_issue_new_refresh_token' => true,
                ],
                'authorization_code' => [
                    'class' => 'OAuth2\GrantType\AuthorizationCode',
                ],
            ],
            'components'          => [
                'request'  => function () {
                    return \filsh\yii2\oauth2server\Request ::createFromGlobals();
                },
                'response' => [
                    'class' => \filsh\yii2\oauth2server\Response ::className(),
                ],
            ],
        ],
        'v1'     => [
            'class' => 'api\modules\v1\Module',
        ],
    ],
    'components'          => [
        'authManager'  => [
            'class'        => 'wind\rest\components\DbManager', //配置文件
            'defaultRoles' => ['普通员工'],//选填，默认角色（默认角色下->公共权限（登陆，oauth2，首页等公共页面））
//            'groupTable' => 'auth_groups',//选填，分组表(已默认，可根据自己表名修改)
//            'groupChildTable' => 'auth_groups_child',//选填，分组子表(已默认，可根据自己表名修改)
        ],
        'request'      => [
            'csrfParam' => '_csrf-api',
            'parsers'   => [
                'application/json' => 'yii\web\JsonParser',
                'text/json'        => 'yii\web\JsonParser',
            ],
        ],
        'user'         => [
            'identityClass'   => 'api\models\User',
            'enableAutoLogin' => true,
            'identityCookie'  => ['name' => '_identity-api', 'httpOnly' => true],
            'loginUrl'        => array('site/login'), //设置默认的鉴权失败的登陆地址
        ],
        'session'      => [
            // this is the name of the session cookie used for login on the api
            'name' => 'advanced-api',
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager'   => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => require(__DIR__.'/route/url-rules.php'),
        ],
    ],
    'as access'           => [
        'class'        => 'wind\rest\components\AccessControl',
        'allowActions' => [
            'site/*',//允许访问的节点，可自行添加
            'rbac/*',//可将路由配置到“普通员工”（默认角色）下
            'oauth2/*',//可将路由配置到“普通员工”（默认角色）下
            'user/*',
            'gii/*',
        ],
    ],
    'params'              => $params,
];
