<?php
/**
 * Created by PhpStorm.
 * User: singwa
 * Date: 2019-11-22
 * Time: 09:33
 */

namespace app\controller;

use app\Request;
use think\facade\Request as Abc;
class Learn {
    public function index(Request $request) {
        dump($request->param("abc")); // 第二种方式

        dump(input("abc")); // 第三种方式

        // 第四种方式
        dump(request()->param("abc"));

        // 第五种方法
        dump(Abc::param("abc"));

        $request->isPost();
        $request->isAjax();
        $request->isGet();

    }
}