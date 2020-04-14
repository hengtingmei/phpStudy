<?php
declare (strict_types = 1);//开启强类型
namespace app\admin\middleware;

class Auth
{
    public function handle($request, \Closure $next)
    {
    	// 前置中间件
    	$response = $next($request);
    	// dump($request);
    	// dump($request->controller());
        // 后置中间件

        // api 页面
        if (empty(session(config("admin.session_admin"))) && $request->controller() != "Login") {
        	return redirect((string)url("Login/index"));
        }
        return $response;

    }
    
    /*
		*中间件结束调度
    */
    public function end(\think\Response $response){
    }
}
