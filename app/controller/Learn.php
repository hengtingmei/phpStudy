<?php
namespace app\controller;

use app\Request;
use think\facade\Request as Abc;
class Learn
{
    public function index(request $request)
    {
        dump($request->param()); //第二种方式
        dump(input('name')); //第三种方式

        //第四种方式
        dump(request()->param());

        //第五种方式
        dump(Abc::param());

        $request->isPost();
        $request->isAjax();
        $request->isGet();
    }
}
