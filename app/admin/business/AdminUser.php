<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 23:32
 */
namespace app\admin\business;
use app\common\model\mysql\AdminUser as AdminUserModel;

class AdminUser {
    public $userModelObj = null;

    public function __construct()
    {
        $this->userModelObj = new AdminUserModel();
    }

    public function login($data) {
        // 常规的做法：
        $user = $this->getAdminUserByUsername($data['username']);

        if(!$user) {
            throw new \think\Exception("不存在该用户");
            // return show(config('status.error'), "不存在该用户");
        }

        if($user['password'] != md5($data['password']."_htm")) {
            throw new \think\Exception("输入的密码错误");
            // return show(config('status.error'), "输入的密码错误");
        }
        // 记录session
        session('adminUser', $user);
        // 设置模拟错误陷阱， 比如数据库内容错误等
        // 更新表的数据
        $updateData = [
            "last_login_time" => time(),
            "last_login_ip" => request()->ip(),
            "update_time" => time()
        ];
        $res = $this->userModelObj->updateById($user['id'], $updateData);
        return true;
    }

    public function getAdminUserByUsername($username) {
        $user = $this->userModelObj->getAdminUserByUsername($username);

        if(empty($user) || $user->status != config("status.mysql.table_normal")) {
            return [];
        }

        $user = $user->toArray();
        return $user;
    }

    public static function updateById($id, $data) {
        
    }
}