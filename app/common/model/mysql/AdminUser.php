<?php
/*
 * 模型类的命名规则是除去表前缀的数据表名称，采用驼峰法命名，并且首字母大写
*/
namespace app\common\model\mysql;
use think\Model;
class AdminUser extends Model
{
    /*  
    */
	public function getAdminUserByUsername($username)
    {
        if (empty($username)) {
            return false;
        }

        $where = [
            'username' => trim($username),
        ];

        $result = $this->where($where)->find();
        return $result;
    }

    public function updateById($id, $data){
        if (empty($id) || empty($data) || !is_array($data)) {
            return false;
        }

        $where = [
            "id" => $id
        ];

        return $this->where($where)->save($data);
    }
}
