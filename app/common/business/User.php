<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 10:25
 */

namespace app\common\business;
use app\common\model\mysql\User as UserModel;
use app\common\lib\Str;
use app\common\lib\Time;
class User {
    public $userObj = null;
    public function __construct()
    {
        $this->userObj = new UserModel();
    }

    public function login($data) {
        switch ($data['ltype']) {
            case '0': // 手机号验证码登录
                // 短信验证验证
                $redisCode = cache(config("redis.code_pre").$data['phone_number']);
                if(empty($redisCode) || $redisCode  != $data['code']) {
                    throw new \think\Exception("不存在该验证码", -1009);
                }

                // 用户信息
                $user = $this->userObj->getUserByPhoneNumber($data['phone_number']);

                // 需要去判断表 是否有 用户记录   phone_number
                // 生成token
                if(!$user) {
                    $username = "singwa粉-".$data['phone_number'];
                    $userData = [
                        'username' => $username,
                        'phone_number' => $data['phone_number'],
                        'type' => $data['type'],
                        'status' => config('status.mysql.table_normal'),

                    ];
                    try {
                        $this->userObj->save($userData);
                        $userId = $this->userObj->id;
                    }catch (\Exception $e) {
                        throw new \think\Exception("数据库内部异常");
                    }

                } else {
                    $userId = $user->id;
                    $username = $user->username;
                }
                break;
            case '1': // 用户名密码登录
                // 用户信息
                $user = $this->userObj->getUserByUsername($data['username']);
                if(!$user) {
                     throw new \think\Exception("用户不存在");
                }

                if($user['password'] != md5($data['password']."_htm")) {
                    throw new \think\Exception("输入的密码错误");
                }

                $userId = $user->id;
                $username = $user->username;
                break;
        }

        $token = Str::getLoginToken($userId);
        $redisData = [
            "id" => $userId,
            "username" => $username,
        ];

        $res = cache(config("redis.token_pre").$token, $redisData, Time::userLoginExpiresTime($data['type']));
        return $res ? ["token" => $token, "username" => $username] : false;
    }

    /**
     * 返回正常用户数据
     * @param $id
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getNormalUserById($id) {
        $user = $this->userObj->getUserById($id);
        if(!$user || $user->status != config("status.mysql.table_normal")) {
            return [];
        }
        return $user->toArray();
    }

    /**
     * 返回正常用户数据
     * @param $id
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getNormalUserByUsername($username) {
        $user = $this->userObj->getUserByUsername($username);
        if(!$user || $user->status != config("status.mysql.table_normal")) {
            return [];
        }
        return $user->toArray();
    }

    public function update($id, $data) {
        $user = $this->getNormalUserById($id);
        if(!$user) {
            throw new \think\Exception("不存在该用户");
        }

        //检查用户名是否存在
        $userResult = $this->getNormalUserByUsername($data['username']);
        if($userResult && $userResult['id'] != $id) {
            throw new \think\Exception("该用户已经存在请重新设置");
        }
        return $this->userObj->updateById($id, $data);
    }
}