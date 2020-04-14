<?php
namespace app\demo\controller;

use app\BaseController;
use app\common\business\Demo;

class Index extends BaseController
{
    public function index()
    {
    	$categoryId = $this->request->param("category_id","0","intval");
    	if (empty($categoryId)) {
 			return show(config("status.error"),"参数错误");
    	}
    	// $limit = 10;
 		$demo = new Demo();
 		$result = $demo->getDemoDataByCategoryId($categoryId,$limit);
 		return show(config("status.success"),"ok",$result);

    }

    public function hello($name = 'ThinkPHP6')
    {
        return 'hello,' . $name;
    }
}
