<?php
namespace app\admin\controller;

use app\BaseController;
use think\facade\View;
use app\common\model\mysql\AdminUser;
class Login extends AdminBase
{
    public function initialize(){
        // 如果不加这个方法在AdminBase下跳转登录页会重定向过多而报错

        if ($this->isLogin()) {
            return $this->redirect(url("Index/index"));
        }
    }

    public function index()
    {
        return View::fetch();
    }

    public function md5(){
        echo md5('admin_htm');
    }

    public function check(){
    	if (!$this->request->isPost()) {
    		return show(config("status.error"),'请求方式错误');
    	}

    	// 参数校验 1、原生方式 2、TP6 验证机制
    	$username = $this->request->param("username", "", "trim");
    	$password = $this->request->param("password", "", "trim");
    	$captcha = $this->request->param("captcha", "", "trim");
    	if(empty($username) || empty($password) || empty($captcha)){
    		return show(config("status.error"),'参数不能为空');
    	}

    	// 校验验证码 需在中间件手动开启session
    	if (!captcha_check($captcha)) {
    		return show(config("status.error"),'验证码不正确');
    	}
        try{
            $adminUserObj = new AdminUser();
            $adminUser = $adminUserObj->getAdminUserByUsername($username);
            // halt($adminUser);
            if (empty($adminUser) || $adminUser->status !== config("status.mysql.table_normal")) {
                return show(config("status.error"),'不存在该用户');
            }
            $adminUser = $adminUser->toArray();

            // 判断密码是否正确
            if($adminUser['password'] != md5($password.'_htm')){
                return show(config("status.error"),'密码错误');
            }

            // 需要记录信息到MySQL表
            $updateData = [
                "last_login_time" => time(),
                "last_login_ip" => request()->ip(),
                "update_time" => time(),
            ];
            $res = $adminUserObj->updateById($adminUser['id'], $updateData);

            if (empty($res)) {
                return show(config("status.error"),'登录失败');
            }
        } catch (\Exception $e){
            // todo 记录日志 $e->getMessage();
            return show(config("status.error"),'内部异常，登录失败');
        }

        // 记录session
        session(config("admin.session_admin"),$adminUser);


    	return show(config("status.success"),'登录成功');
    }
    
}
