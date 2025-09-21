<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;

// // Luma 风格的核心路由 - 专注活动创建
Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\LumaController@index');
Router::get('/create', 'App\Controller\LumaController@create');
Router::get('/login', 'App\Controller\LumaController@login');
Router::get('/register', 'App\Controller\LumaController@register');
Router::get('/management', 'App\Controller\LumaController@management');

// // 保留原始演示页面
// Router::addRoute(['GET', 'POST', 'HEAD'], '/original', 'App\Controller\IndexController@index');
// Router::get('/demo', 'App\Controller\DemoController@index');

Router::get('/favicon.ico', function () {
    return '';
});

// 处理 Chrome DevTools 的自动请求
Router::get('/.well-known/appspecific/com.chrome.devtools.json', function () {
    return response('', 204); // 返回 204 No Content 状态
});
