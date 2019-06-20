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
use Illuminate\Foundation\Application as App;
define('ROOT_ROUTE', realpath(__DIR__.'/../routes/api'));
$route_files = scandir(ROOT_ROUTE);

$middleware_except = App()->config->get('app.middleware_except');

foreach ($route_files as $key => $file) {
	$pathinfo = pathinfo($file);
    if ($pathinfo['extension'] === 'php') {
    	$config = include(ROOT_ROUTE . '/' . $file);
    	foreach ($config['route'] as $route) {
            list($uri, $method, $func) = $route;
            $method = strtolower($method);
            if (isset($middleware_except[$config['handler']]) && in_array($func, $middleware_except[$config['handler']])) {
                Route::$method($uri, $config['handler'] . '@' . $func);
            } else {
                Route::$method($uri, $config['handler'] . '@' . $func)->middleware('auth:api');
            }
            
        }
    }
}

// die;
// Route::group(['middleware' => 'auth:api'], function() {
//     Route::get('photo', 'Api\PhotoController@index');
//     Route::get('test', function() {
//         return response()->json(request()->user());
//     });
// });



