<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 09:04
 */

namespace app\demo\middleware;

class Detail {

    public function handle($request, \Closure $next) {

        $request->type = "detail";

        return $next($request);
    }

    /**
     * 中间件结束调度
     * @param \think\Response $response
     */
    public function end(\think\Response $response) {

    }
}