<?php
namespace api\controllers;

use Yii;
use yii\web\Controller;
use filsh\yii2\oauth2server\controllers\RestController;

/**
 * Site controller
 */
class UserController extends RestController
{
    public function actionToken()
    {
        $OauthModule = Yii::$app->getModule('oauth2');
        $response = $OauthModule->getServer()->handleTokenRequest();
        $res= $response->getParameters();
        if(!empty($res['access_token'])){
            $res['code']=20000;
            $res['message']='sucsess';
        }
        return $res;
    }
    public function actionInfo()
    {
        $res = array(
            "code" => 20000,
            "message" => 'sucsess',
            'data' => array(
                "roles" => ['admin'],
                "introduction" => "I am a super administrator",
                "avatar" => "https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif",
                "name" => "Super Admin",
                "mark" => "api server",
            )
        );
        return $res;
    }

    public function actionTransactionlist()
    {
//        return {
//        code: 20000,
//        data: {
//            total: 20,
//          'items|20': [{
//                order_no: '@guid()',
//            timestamp: +Mock.Random.date('T'),
//            username: '@name()',
//            price: '@float(1000, 15000, 0, 2)',
//            'status|1': ['success', 'pending']
//          }]
//        }
//      }
        $res = [
            "code" => 20000,
            "message" => 'sucsess',
            'data' =>[
                "total" => 20,
                "items" => [
                    [
                        'order_no' => '10001',
                        'timestamp' => '',
                        'username' => 'Aaron',
                        'price' => '1245',
                        'status' => 'success'
                    ],
                    [
                        'order_no' => '10002',
                        'timestamp' => '',
                        'username' => 'Jack',
                        'price' => '16542',
                        'status' => 'pending'
                    ],
                    [
                        'order_no' => '10003',
                        'timestamp' => '',
                        'username' => 'Luc',
                        'price' => '2547',
                        'status' => 'success'
                    ],
                ],
            ],
        ];
        return $res;
    }

}
