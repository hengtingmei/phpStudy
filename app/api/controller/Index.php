<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 23:38
 */
namespace app\api\controller;
use app\common\business\Goods as GoodsBis;
use app\common\lib\Show;
class Index extends ApiBase {

    public function getRotationChart() {
        $result = (new GoodsBis())->getRotationChart();
        return Show::success($result);
    }

    public function cagegoryGoodsRecommend() {
        $categoryIds = [
            71,
            51
        ];
        $result = (new GoodsBis())->cagegoryGoodsRecommend($categoryIds);
        return Show::success($result);
    }
}