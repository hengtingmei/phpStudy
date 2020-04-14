<?php
/*
 * 模型类的命名规则是除去表前缀的数据表名称，采用驼峰法命名，并且首字母大写
*/
namespace app\common\model\mysql;
use think\Model;
class Demo extends Model
{
	public function getDemoDataByCategoryId($categoryId,$limit=10)
    {
        if (empty($categoryId)) {
            return [];
        }

        $result = $this->where($categoryId)
            ->limit($limit)
            ->order("id","desc")
            ->select()
            ->toArray();
        return $result;
    }
}
