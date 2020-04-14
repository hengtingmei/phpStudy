<?php
namespace app\controller;

use app\BaseController;

class Demo extends BaseController
{
    public function show()
    {
        $request = [
        	'status' => 1,
        	'message' => 'success',
        	'result' => [
        		'id' =>11
        	],
        ];
        $header = [
        	'Token' =>'2313'
        ];
    	return json($request,201,$header);
    }

    public function request()
    {
    	$this->request->get();
    	$this->request->post();
        dump($this->request->param('name','meimei','string'));//第一种方式
        dump($this->request->param('b'));
        dump(input());
    }
}
