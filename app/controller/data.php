<?php
namespace app\controller;

use think\facade\DB;
use app\model\User;
class Data
{
    public function index()
    {    
        /*单个数据*/
        // table方法必须指定完整的数据表名
        // Db::table('think_user')->where('id', 1)->find();
        // Db::table('think_user')->where('id', '>', 1)->find();

        // 如果希望查询数据不存在的时候返回空数组，可以使用
        // table方法必须指定完整的数据表名
        // Db::table('think_user')->where('id', 1)->findOrEmpty();

        // 如果希望查询数据不存在的时候返回空数组，可以使用
        // table方法必须指定完整的数据表名
        // Db::table('think_user')->where('id', 1)->findOrEmpty();

        /*查询数据集*/
        // 方法查询结果是一个数据集对象，如果需要转换为数组可以使用
        dump(DB::table('pigcms_mall_group_user')->where('status', 1)->select()->toArray());

        // 如果希望在没有查找到数据后抛出异常可以使用
        // Db::table('think_user')->where('status',1)->selectOrFail();

        // 如果设置了数据表前缀参数的话，可以使用
        // Db::name('user')->where('id', 1)->find();
        // Db::name('user')->where('status', 1)->select();

        /*值和列查询*/
        // 返回某个字段的值
        // Db::table('think_user')->where('id', 1)->value('name'); //value 方法查询结果不存在，返回 null

        // 查询某一列的值可以用
        // 返回数组
        // Db::table('think_user')->where('status',1)->column('name');
        // 指定id字段的值作为索引
        // Db::table('think_user')->where('status',1)->column('name', 'id');


        // 数据分批处理
        // Db::table('think_user')->chunk(100, function($users) {
        //     foreach ($users as $user) {
        //         //
        //         }
        //     });

        // 你可以通过从闭包函数中返回false来中止对后续数据集的处理：
        // Db::table('think_user')->chunk(100, function($users) {
        //     foreach ($users as $user) {
        //         // 处理结果集...
        //         if($user->status==0){
        //             return false;
        //         }
        //     }
        // });

        // 也支持在chunk方法之前调用其它的查询方法，例如：
        // Db::table('think_user')
        //     ->where('score','>',80)
        //     ->chunk(100, function($users) {
        //         foreach ($users as $user) {
        //             //
        //         }
        //     });

        // chunk方法的处理默认是根据主键查询，支持指定字段，例如：
        // Db::table('think_user')->chunk(100, function($users) {
        //     // 处理结果集...
        //     return false;
        // },'create_time');

        // 并且支持指定处理数据的顺序。
        // Db::table('think_user')->chunk(100, function($users) {
        //     // 处理结果集...
        //     return false;
        // },'create_time', 'desc');

        // chunk方法一般用于命令行操作批处理数据库的数据，不适合WEB访问处理大量数据，很容易导致超时。

        // 如果你需要处理大量的数据，可以使用新版提供的游标查询功能，该查询方式利用了PHP的生成器特性，可以大幅减少大量数据查询的内存开销问题。
        // $cursor = Db::table('user')->where('status', 1)->cursor();
        // foreach($cursor as $user){
        //     echo $user['name'];
        // }
        // cursor方法返回的是一个生成器对象，user变量是数据表的一条数据（数组）。

    }

    public function insert(){
        /*添加一条数据*/
        // 可以使用save方法统一写入数据，自动判断是新增还是更新数据（以写入数据中是否存在主键数据为依据）。

        // $data = ['foo' => 'bar', 'bar' => 'foo'];
        // Db::name('user')->save($data);

        // 或者使用 insert 方法向数据库提交数据
        // $data = ['foo' => 'bar', 'bar' => 'foo'];
        // Db::name('user')->insert($data);
        // insert 方法添加数据成功返回添加成功的条数，通常情况返回 1

        // 如果你的数据表里面没有foo或者bar字段，那么就会抛出异常。
        // 如果不希望抛出异常，可以使用下面的方法：

        // $data = ['foo' => 'bar', 'bar' => 'foo'];
        // Db::name('user')->strict(false)->insert($data);
        // 不存在字段的值将会直接抛弃。

        // 如果是mysql数据库，支持replace写入，例如：

        // $data = ['foo' => 'bar', 'bar' => 'foo'];
        // Db::name('user')->replace()->insert($data);
        // 添加数据后如果需要返回新增数据的自增主键，可以使用insertGetId方法新增数据并返回主键值：

        // $userId = Db::name('user')->insertGetId($data);
        // insertGetId 方法添加数据成功返回添加数据的自增主键

        /*添加多条数据*/
        // 添加多条数据直接向 Db 类的 insertAll 方法传入需要添加的数据（通常是二维数组）即可。insertAll方法添加数据成功返回添加成功的条数

        // $data = [
        //     ['foo' => 'bar', 'bar' => 'foo'],
        //     ['foo' => 'bar1', 'bar' => 'foo1'],
        //     ['foo' => 'bar2', 'bar' => 'foo2']
        // ];
        // Db::name('user')->insertAll($data);

        // 如果是mysql数据库，支持replace写入，例如：
        // $data = [
        //     ['foo' => 'bar', 'bar' => 'foo'],
        //     ['foo' => 'bar1', 'bar' => 'foo1'],
        //     ['foo' => 'bar2', 'bar' => 'foo2']
        // ];
        // Db::name('user')->replace()->insertAll($data);

        // 如果批量插入的数据比较多，可以指定分批插入，使用limit方法指定每次插入的数量限制。
        // $data = [
        //     ['foo' => 'bar', 'bar' => 'foo'],
        //     ['foo' => 'bar1', 'bar' => 'foo1'],
        //     ['foo' => 'bar2', 'bar' => 'foo2']
        //     ...
        // ];
        // // 分批写入 每次最多100条数据
        // Db::name('user')
        //     ->limit(100)
        //     ->insertAll($data);

    }

    public function update(){
        /*更新数据*/
        // 可以使用save方法更新数据

        // Db::name('user')
        //     ->save(['id' => 1, 'name' => 'thinkphp']);

        // 或者使用update方法。方法返回影响数据的条数，没修改任何数据返回 0
        // Db::name('user')
        //     ->where('id', 1)
        //     ->update(['name' => 'thinkphp']);

        // 支持使用data方法传入要更新的数据，如果update方法和data方法同时传入更新数据，则以update方法为准。
        // Db::name('user')
        //     ->where('id', 1)
        //     ->data(['name' => 'thinkphp'])
        //     ->update();

        // 如果数据中包含主键，可以直接使用：
        // Db::name('user')
        //     ->update(['name' => 'thinkphp','id' => 1]);

        // 如果要更新的数据需要使用SQL函数或者其它字段，可以使用下面的方式：
        // Db::name('user')
        //     ->where('id',1)
        //     ->exp('name','UPPER(name)')
        //     ->update();
        // UPDATE `think_user`  SET `name` = UPPER(name)  WHERE  `id` = 1

        // 支持使用raw方法进行数据更新。
        // Db::name('user')
        //     ->where('id', 1)
        //     ->update([
        //         'name'      =>  Db::raw('UPPER(name)'),
        //         'score'     =>  Db::raw('score-3'),
        //         'read_time' =>  Db::raw('read_time+1')
        //     ]);

        // score 字段加 1
        // Db::table('think_user')
        //     ->where('id', 1)
        //     ->inc('score')
        //     ->update();

        // score 字段加 5
        // Db::table('think_user')
        //     ->where('id', 1)
        //     ->inc('score', 5)
        //     ->update();

        // score 字段减 1
        // Db::table('think_user')
        //     ->where('id', 1)
        //     ->dec('score')
        //     ->update();

        // score 字段减 5
        // Db::table('think_user')
        //     ->where('id', 1)
        //     ->dec('score', 5)
        //     ->update();
    }

    public function delete(){
        // delete方法返回影响数据的条数，没有删除返回 0

        // 根据主键删除
        // Db::table('think_user')->delete(1);
        // Db::table('think_user')->delete([1,2,3]);

        // 条件删除    
        // Db::table('think_user')->where('id',1)->delete();
        // Db::table('think_user')->where('id','<',10)->delete();
        

        // 如果不带任何条件调用delete方法会提示错误，如果你确实需要删除所有数据，可以使用
        // 无条件删除所有数据
        // Db::name('user')->delete(true);

        // 软删除数据 使用delete_time字段标记删除
        // Db::name('user')
        //     ->where('id', 1)
        //     ->useSoftDelete('delete_time',time())
        //     ->delete();
        // 实际生成的SQL语句可能如下（执行的是UPDATE操作）：
        // UPDATE `think_user`  SET `delete_time` = '1515745214'  WHERE  `id` = 1
        // useSoftDelete方法表示使用软删除，并且指定软删除字段为delete_time，写入数据为当前的时间戳。
    }

    public function gaoji(){

        // 快捷查询方式是一种多字段相同查询条件的简化写法，可以进一步简化查询条件的写法，在多个字段之间用|分割表示OR查询，用&分割表示AND查询，可以实现下面的查询，例如：

        // Db::table('think_user')
        //     ->where('name|title','like','thinkphp%')
        //     ->where('create_time&update_time','>',0)
        //     ->find();
        // SELECT * FROM `think_user` WHERE ( `name` LIKE 'thinkphp%' OR `title` LIKE 'thinkphp%' ) AND ( `create_time` > 0 AND `update_time` > 0 ) LIMIT 1

        // Db::table('think_user')
        //     ->where([
        //         ['name', 'like', 'thinkphp%'],
        //         ['title', 'like', '%thinkphp'],
        //         ['id', '>', 0],
        //         ['status', '=', 1],
        //     ])
        //     ->select();
        // SELECT * FROM `think_user` WHERE `name` LIKE 'thinkphp%' AND `title` LIKE '%thinkphp' AND `id` > 0 AND `status` = '1'

        // 注意，相同的字段的多次查询条件可能会合并，如果希望某一个where方法里面的条件单独处理，可以使用下面的方式，避免被其它条件影响。
        // $map = [
        //     ['name', 'like', 'thinkphp%'],
        //     ['title', 'like', '%thinkphp'],
        //     ['id', '>', 0],
        // ];
        // Db::table('think_user')
        //     ->where([ $map ])
        //     ->where('status',1)
        //     ->select();
        // SELECT * FROM `think_user` WHERE ( `name` LIKE 'thinkphp%' AND `title` LIKE '%thinkphp' AND `id` > 0 ) AND `status` = '1'

        // 如果使用下面的多个条件组合
        // $map1 = [
        //         ['name', 'like', 'thinkphp%'],
        //         ['title', 'like', '%thinkphp'],
        //     ];
            
        // $map2 = [
        //         ['name', 'like', 'kancloud%'],
        //         ['title', 'like', '%kancloud'],
        //     ];    
            
        // Db::table('think_user')
        //     ->whereOr([ $map1, $map2 ])
        //     ->select();
        // SELECT * FROM `think_user` WHERE ( `name` LIKE 'thinkphp%' AND `title` LIKE '%thinkphp' ) OR ( `name` LIKE 'kancloud%' AND `title` LIKE '%kancloud' )

        /*闭包查询*/
        // $name = 'thinkphp';
        // $id = 10;
        // Db::table('think_user')->where(function ($query) use($name, $id) {
        //     $query->where('name', $name)
        //         ->whereOr('id', '>', $id);
        // })->select();
        // 生成的SQL语句为：

        // SELECT * FROM `think_user` WHERE ( `name` = 'thinkphp' OR `id` > 10 )

        /*事务操作*/
        // 最简单的方式是使用 transaction 方法操作数据库事务，当闭包中的代码发生异常会自动回滚，例如：
        // Db::transaction(function () {
        //     Db::table('think_user')->find(1);
        //     Db::table('think_user')->delete(1);
        // });

        // 也可以手动控制事务，例如：
        // 启动事务
       /* Db::startTrans();
        try {
            Db::table('think_user')->find(1);
            Db::table('think_user')->delete(1);
            // 提交事务
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
        }*/
    }

    public function model(){
        
    }
}