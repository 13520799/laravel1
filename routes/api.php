<?php
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
use Illuminate\Http\Request;
use Illuminate\Http\Response;
//define('ROOT_PATH', realpath(__DIR__.'/../'));

$route_files = scandir(ROOT_PATH . '/routes/api');


foreach ($route_files as $key => $file) {
	$pathinfo = pathinfo($file);
    if ($pathinfo['extension'] === 'php') {
    	$config = include(ROOT_PATH . '/routes/api/' . $file);
    	foreach ($config['route'] as $route) {
            list($uri, $method, $func) = $route;
            $method = strtolower($method);
            Route::$method($uri, $config['handler'] . '@' . $func);
        }
    }
}

//Route::get('photo', 'Api\PhotoController@index');

