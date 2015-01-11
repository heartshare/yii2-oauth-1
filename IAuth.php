<?php

namespace ivantree\oauth;

/**
 * Sina Weibo OAuth
 */
interface IAuth {

    /**
     * get User Info
     * @return []
     */
    public function getUserInfo();
}
