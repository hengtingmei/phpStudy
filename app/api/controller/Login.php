<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 17:51
 */
declare(strict_types = 1);
namespace app\api\controller;

use app\BaseController;
class Login extends BaseController {
    public function index() :object {
        if(!$this->request->isPost()) {
            return show(config("status.error"), "非法请求");
        }
        $phoneNumber  = $this->request->param("phone_number", "", "trim");
        $username  = $this->request->param("username", "", "trim");
        $password  = $this->request->param("password", "", "trim");
        $code = input("param.code", 0, "intval");
        $type = input("param.type", 0, "intval");
        $ltype = input("param.ltype", 0, "intval");
        // 参数校验
        $data = [
            'phone_number' => $phoneNumber,
            'username' => $username,
            'password' => $password,
            'code' => $code,
            'type' => $type,
            'ltype' => $ltype,
        ];
        $validate = new \app\api\validate\User();
        switch ($ltype) {
            case '0':
                // 手机号验证码登录
                if(!$validate->scene('login')->check($data)) {
                    return show(config('status.error'), $validate->getError());
                }
                break;
            case '1':
                // 用户名密码登录
                if(!$validate->scene('username_login')->check($data)) {
                    return show(config('status.error'), $validate->getError());
                }
                break;
        }


        try {
            $result = (new \app\common\business\User())->login($data);
        } catch (\Exception $e) {
            return show($e->getCode(), $e->getMessage());
        }
        if($result) {
            return show(config('status.success'), "登录成功", $result);
        }
        return show(config('status.error'), "登录失败");
    }
}