<?php

namespace common\components\oauth;

use Yii;
use yii\authclient\OAuth2;

/**
 * Baidu OAuth
 */
class Baidu extends OAuth2 implements IAuth {

    public $authUrl = 'https://openapi.baidu.com/oauth/2.0/authorize';
    public $tokenUrl = 'https://openapi.baidu.com/oauth/2.0/token';
    public $apiBaseUrl = 'https://openapi.baidu.com/';

    /**
     * 
     * @return []
     * @see http://open.weibo.com/wiki/Oauth2/get_token_info
     * @see http://open.weibo.com/wiki/2/users/show
     */
    protected function initUserAttributes() {
        return $this->api('rest/2.0/passport/users/getLoggedInUser', 'GET');
    }

    /**
     * get UserInfo
     * @return []
     * @see http://open.weibo.com/wiki/2/users/show
     */
    public function getUserInfo() {
        $openid = $this->getUserAttributes();
        return $this->api("rest/2.0/passport/users/getLoggedInUser", 'GET', ['uid' => $openid['uid']]);
    }

    protected function defaultName() {
        return 'Baidu';
    }

    protected function defaultTitle() {
        return 'Baidu';
    }

    protected function defaultViewOptions() {
        return [
            'popupWidth' => 800,
            'popupHeight' => 500,
        ];
    }

}
