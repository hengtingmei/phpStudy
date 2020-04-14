<?php
/**
 * Created by PhpStorm.
 * User: singwa
 * Date: 2019-11-19
 * Time: 08:58
 */
namespace app\controller;

use app\BaseController;
use think\facade\Db;
use app\common\lib\Snowflake;
class Demo extends BaseController {

    public function show() {

        $result  = [
            "status" => 1,
            "message" => "OK",
            "result" => [
                'id' => 1,
            ],
        ];

        $header = [
            "Token" => "e23gdt55",
        ];
        // json
        return json($result, 201, $header);
    }

    public function request() {
        // 第一种获取方式
        dump($this->request->param("abc", 1, "intval"));
    }


}
