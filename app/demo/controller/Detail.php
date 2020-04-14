<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 07:32
 */
namespace app\demo\controller;


use app\BaseController;

class Detail extends BaseController {

    public function index() {
        dump($this->request->type);
    }


}