<?php
namespace app\admin\controller;

use app\BaseController;
use think\facade\View;
class index extends AdminBase
{
    public function index()
    {
        return View::fetch();
        // echo "hello-admin";
    }
    
    public function welcome(){
        return View::fetch();

    }
}
