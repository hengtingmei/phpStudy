<?php
/**
 * Created by PhpStorm.
 * User: singwa
 * Date: 2019-11-26
 * Time: 09:10
 */
use think\facade\Route;


Route::rule("demo/test", "index/hello", "GET");

Route::rule("detail", "detail/index", "GET")->middleware(\app\demo\middleware\Detail::class );

