<?php
namespace app\controller;

class Error
{
   public function __call($name,$arguments){
        // dump($name);
        // dump($arguments);

        //api
        // $result = [
        //     'status' => 0,
        //     'message' => '找不到该控制器',
        //     'result' => null,
        // ];
        return show(config("status.controller_not_found"),"找不到{$name}控制器",400);;
    }
}
