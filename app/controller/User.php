<?php
namespace app\controller;

use app\model\User;

class User 
{
	// suffix方法用于静态查询
	// $blog = User::suffix('_en')->find();
	// $blog->name = 'test';
	// $blog->save();

	// setSuffix用于动态设置
	// $blog = new User($data);
	// $blog->setSuffix('_en')->save();

	$user = User::find(1);
	echo $user->create_time;  
	echo $user->name;

	// 由于模型类实现了ArrayAccess接口，所以可以当成数组使用。
	$user = User::find(1);
	echo $user['create_time'];  
	echo $user['name'];

	// 可以使用下面的代码给模型对象赋值
	$user = new User();
	$user->name = 'thinkphp';
	$user->score = 100;
	// 该方式赋值会自动执行模型的修改器，如果不希望执行修改器操作，可以使用
	$data['name'] = 'thinkphp';
	$data['score'] = 100;
	$user = new User($data);


}
