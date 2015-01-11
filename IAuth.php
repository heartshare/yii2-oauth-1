<?php

namespace common\components\oauth;

/**
 * Sina Weibo OAuth
 * @author xjflyttp <xjflyttp@gmail.com>
 */
interface IAuth {

    /**
     * get User Info
     * @return []
     */
    public function getUserInfo();
}
