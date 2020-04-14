<?php
/*
 * 模型类的命名规则是除去表前缀的数据表名称，采用驼峰法命名，并且首字母大写
*/
namespace app\model;
use think\Model;
class User extends Model
{
	/***你想指定数据表甚至数据库连接的话 start*/

	// 设置当前模型对应的完整数据表名称
    // protected $table = 'think_user';
    
    // 设置当前模型的数据库连接
    // protected $connection = 'db_config';
    // connection属性使用用配置参数名（需要在数据库配置文件中的connections参数中添加对应标识）。

	/***你想指定数据表甚至数据库连接的话 end*/

    protected $pk = 'uid';

	/*动态切换后缀*/
    // 定义默认的表后缀（默认查询中文数据）
    // protected $suffix = '_cn';

	// 模型的数据字段和对应数据表的字段是对应的，默认会自动获取（包括字段类型），但自动获取会导致增加一次查询，因此你可以在模型中明确定义字段信息避免多一次查询的开销。
    // 设置字段信息
    protected $schema = [
        'uid'          => 'int',
        'name'        => 'string',
        'status'      => 'int',
        'score'       => 'float',
        'create_time' => 'datetime',
        'update_time' => 'datetime',
    ];

    // 模型初始化
    // init必须是静态方法，并且只在第一次实例化的时候执行，并且只会执行一次
    protected static function init()
    {
        //TODO:初始化内容
    }

    public function get_user(){
		// 如果你是在模型内部获取数据的话，需要改成：
		$user = $this->find(1);
		echo $user->getAttr('create_time');  
		echo $user->getAttr('name');
    }
}
