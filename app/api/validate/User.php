<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 23:52
 */

namespace app\api\validate;

use think\Validate;

class User extends  Validate {
    protected $rule = [
        'username' => 'require',
        'password' => 'require',
        'phone_number' => 'require',
        'code'  =>  'require|number|min:4',
        //'type' => 'require|in:1,2',
        'type' => ["require", "in"=>"1,2"], // 两种不同的方式而已
        'sex' => ["require", "in"=>"0,1,2"],
        'captcha' => 'require|checkCapcha'
    ];

    protected $message = [
        'username' => '用户名必须',
        'phone_number' => '电话号码必须',
        'code.require' => '短信验证码必须',
        'code.number'  =>  '短信验证码必须为数字',
        'code.min'  =>  '短信验证码长度不得低于4',
        'type.require' => '类型必须',
        'type.in' => '类型数值错误',
        'sex.require' => '性别必须',
        'sex.in' => '性别数值错误'
    ];

    protected $scene = [
        'send_code' => ['phone_number'],
        'login' => ['phone_number', 'code', 'type'],
        'update_user' => ['username', 'sex'],
        'username_login' => ['username','password'],
    ];

    protected function checkCapcha($value, $rule, $data = []) {
        if(!captcha_check($value)) {
            return "您输入的验证码不正确！";
        }

        return true;
    }
}