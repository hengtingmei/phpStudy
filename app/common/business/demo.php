<?php
/**
 * 
 */

namespace app\common\business;
use app\common\model\mysql\Demo as DemoModel;

class Demo
{
	public function getDemoDataByCategoryId($categoryId,$limit=10)
	{
		if (empty($categoryId)) {
            return [];
        }

		$model = new DemoModel();
		$result = $model->getDemoDataByCategoryId($categoryId,$limit);

		if (empty($result)) {
            return [];
        }

        foreach ($result as $key => $value) {
        	// 业务逻辑处理
        	# code...
        }
		return $result;
		
	}
}