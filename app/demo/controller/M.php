<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 09:12
 */
namespace app\demo\controller;

use app\BaseController;
use app\common\business\Demo;

class M extends BaseController {

    public function index() {
        $categoryId = $this->request->param("category_id", 0, "intval");
        if(empty($categoryId)) {
            return show(config("status.error"), "参数错误");
        }

        $demo = new Demo();
        $results = $demo->getDemoDataByCategoryId($categoryId);
        //

        return show(config("status.success"), "ok", $results);

    }


}