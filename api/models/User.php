<?php

namespace api\models;

use filsh\yii2\oauth2server\Module;
use Yii;
use common\models\User as commonUser;
use OAuth2\Storage\UserCredentialsInterface;

class User extends commonUser implements UserCredentialsInterface
{
    /**
     * Implemented for Oauth2 Interface
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        /** @var Module $module */
        $module = Yii ::$app -> getModule('oauth2');
        $token  = $module -> getServer() -> getResourceController() -> getToken();

        return !empty($token['user_id'])
            ? static ::findIdentity($token['user_id'])
            :null;
    }

    /**
     * Implemented for Oauth2 Interface
     */
    public function checkUserCredentials($username, $password)
    {
        $user = static ::findByUsername($username);
        if (empty($user)) {
            return false;
        }

        return $user -> validatePassword($password);
    }

    /**
     * Implemented for Oauth2 Interface
     */
    public function getUserDetails($username)
    {
        $user = static ::findByUsername($username);

        return ['user_id' => $user -> getId()];
    }
}
