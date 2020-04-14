<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 07:32
 */
namespace app\demo\controller;


use app\BaseController;

class E extends BaseController {

    public function index() {

        //echo $abc;
        throw new \think\exception\HttpException(400, "找不到相应的数据");

    }

    public function abc() {
        dump($this->request->type);
    }
}