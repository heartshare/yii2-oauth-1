<?php

namespace ivantree\oauth;

use Yii;
use yii\authclient\OAuth2;

/**
 * Weixin OAuth
 */
class Weixin extends OAuth2 implements IAuth {

    public $authUrl = 'https://open.weixin.qq.com/connect/oauth2/authorize';
    public $tokenUrl = 'https://api.weixin.qq.com/sns/oauth2/access_token';
    public $apiBaseUrl = 'https://api.weixin.qq.com/';

    /**
     * 
     * @return []
     * @see http://open.weibo.com/wiki/Oauth2/get_token_info
     * @see http://open.weibo.com/wiki/2/users/show
     */
    protected function initUserAttributes() {
        return $this->api('oauth2/get_token_info', 'POST');
    }

    /**
     * get UserInfo
     * @return []
     * @see http://open.weibo.com/wiki/2/users/show
     */
    public function getUserInfo() {
        $openid = $this->getUserAttributes();
        return $this->api("cgi-bin/user/info", 'GET', ['uid' => $openid['uid']]);
    }

    protected function defaultName() {
        return 'Weixin';
    }

    protected function defaultTitle() {
        return 'Weixin';
    }

    protected function defaultViewOptions() {
        return [
            'popupWidth' => 800,
            'popupHeight' => 500,
        ];
    }

}
