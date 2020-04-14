<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 23:42
 */
namespace app\api\controller\mall;

use app\api\controller\AuthBase;
use app\common\lib\Show;
use app\common\business\Cart;
class Init extends AuthBase {
    public function index() {
        if(!$this->request->isPost()) {
            return Show::error();
        }

        $count = (new Cart())->getCount($this->userId);
        $result = [
            "cart_num" => $count,
        ];
        return Show::success($result);

    }
}