<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 12:31
 */
namespace app\api\controller;
use app\common\business\User as UserBis;


class User extends AuthBase {
    public function index() {
        $user = (new UserBis())->getNormalUserById($this->userId);

        $resultUser = [
            "id" => $this->userId,
            "username" => $user['username'],
            "sex" => $user['sex']
        ];
        return show(config("status.success"), "OK", $resultUser);
    }

    /**
     * PUT
     * @return array|mixed|\think\response\Json
     */
    public function update() {

        $username = input("param.username", "", "trim");
        $sex = input("param.sex", 0, "intval");
        //
        $data = [
            'username' => $username,
            'sex' => $sex
        ];
        $validate = (new \app\api\validate\User())->scene('update_user');
        if(!$validate->check($data)) {
            return show(config('status.error'), $validate->getError());
        }
        $userBisObj = new UserBis();
        $user = $userBisObj->update($this->userId, $data);
        if(!$user) {
            return show(config('status.error'), "更新失败");
        }

        // 如果用户名被修改、redis里面的数据也需要同步一下 这个留给大家一个作业。
        $redisData = [
            'id' => $user['id'],
            'username' => $username,
        ];
        cache(config("redis.token_pre").$this->accessToken, $redisData, Time::userLoginExpiresTime($user['type']));
        
        return show(1, "ok");
    }


}