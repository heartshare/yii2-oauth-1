<?php

namespace ivantree\oauth;

use Yii;
use yii\authclient\OAuth2;

/**
 * QQ OAuth
 * @author xjflyttp <xjflyttp@gmail.com>
 */
class Qq extends OAuth2 implements IAuth {

    public $authUrl = 'https://graph.qq.com/oauth2.0/authorize';
    public $tokenUrl = 'https://graph.qq.com/oauth2.0/token';
    public $apiBaseUrl = 'https://graph.qq.com';

    public function init() {
        parent::init();
        if ($this->scope === null) {
            $this->scope = implode(',', [
                'get_user_info',
            ]);
        }
    }

    protected function initUserAttributes() {
        return $this->api('oauth2.0/me', 'GET');
    }

    /**
     * get UserInfo
     * @return []
     * @see http://wiki.connect.qq.com/get_user_info
     */
    public function getUserInfo() {
        $openid = $this->getUserAttributes();
        return $this->api("user/get_user_info", 'GET', [
                    'oauth_consumer_key' => $openid['client_id'],
                    'openid' => $openid['openid'
        ]]);
    }

    protected function defaultName() {
        return 'Qq';
    }

    protected function defaultTitle() {
        return 'Qq';
    }

    protected function defaultViewOptions() {
        return [
            'popupWidth' => 800,
            'popupHeight' => 500,
        ];
    }

    /**
     * Processes raw response converting it to actual data.
     * @param string $rawResponse raw response.
     * @param string $contentType response content type.
     * @throws Exception on failure.
     * @return array actual response.
     */
    protected function processResponse($rawResponse, $contentType = self::CONTENT_TYPE_AUTO) {
        if ($contentType == self::CONTENT_TYPE_AUTO) {
            //jsonp to json
            if (strpos($rawResponse, "callback") === 0) {
                $lpos = strpos($rawResponse, "(");
                $rpos = strrpos($rawResponse, ")");
                $rawResponse = substr($rawResponse, $lpos + 1, $rpos - $lpos - 1);
                $rawResponse = trim($rawResponse);
                $contentType = self::CONTENT_TYPE_JSON;
            }
        }
        //return parent::processResponse($rawResponse, $contentType);
    }

}
