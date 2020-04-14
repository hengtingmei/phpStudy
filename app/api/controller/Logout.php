<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 13:36
 */
namespace app\api\controller;
class Logout extends AuthBase {
    public function index() {
        // 删除 redis token 缓存
        $res = cache(config("redis.token_pre").$this->accessToken, NULL);
        if($res) {
            return show(config("status.success"), "退出登录成功");
        }
        return show(config("status.error"), "退出登录失败");

    }
}