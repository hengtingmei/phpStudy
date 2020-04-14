<?php
/**
 * Created by PhpStorm.
 * User: singwa
 * Date: 2019-11-26
 * Time: 07:04
 */
namespace app\controller;

use app\BaseController;
use think\facade\Db;
use app\model\Demo;
class Data extends BaseController {
    public function index() {
        //$result = Db::table("mall_demo")->where("id", 1)->find();

        // 通过容器的方式来处理
        //$result = app("db")->table("mall_demo")->where("id", 2)->find();
        $result = Db::table("mall_demo")
            //->order("id", "desc")
            //->limit(2,2) // 分页的逻辑
            //->page(3, 1)
            //->where("id", ">", 2)
            //->where("category_id", 3)
            ->where([
                ["id", "in", "1,2,3,5"],
                ["category_id", "=", 3]
            ])
            ->select();
        dump($result);
    }
    public function abc() {
        // 第一种 输出sql方式
        //$result = Db::table("mall_demo")->where("id", 10)->fetchSql()->find();

        // 第二种 输出sql
        $result = Db::table("mall_demo")->where("id", 10)->find();
        echo Db::getLastSql();exit;
        dump($result);
    }

    public function demo() {
        $data = [
            "title" => "singwa007",
            "content" => "singwa来自北京",
            "category_id" => 2,
            "status" => 1,
            "create_time" => time()
        ];
        // 新增逻辑
        //$result = Db::table("mall_demo")->insert($data);

        // 删除操作
        //$result = Db::table("mall_demo")->where("id", 1)->delete();
        //echo Db::getLastSql();


        // 更新操作
        //$result = Db::table("mall_demo")->where("id", 2)->update(["title" => "singwa0008"]);
        //echo Db::getLastSql();

        $result = Db::table("mall_demo")->where("id", 2)->find();
        dump($result);
    }


    public function model1() {
        $result = Demo::find(2);
        dump($result->toArray());
    }
}