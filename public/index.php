<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */
define('ROOT_PATH', realpath(__DIR__.'/../'));
define('APP_PATH', realpath(ROOT_PATH.'/app'));
define('BOOTSTRAP_PATH', realpath(ROOT_PATH.'/bootstrap'));
define('DS', DIRECTORY_SEPARATOR);
/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/
//Load autoload từ composer
//gọi bootstrap/autoload để gọi autoload của các thư viên trong vendor
require BOOTSTRAP_PATH . '/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/
//khởi tạo đối tượng application của laravel vào trong biến $app
// đăng ký service provide
$app = require_once BOOTSTRAP_PATH . '/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/
//Ứng dụng ($app) sẽ tiến hành tạo (make()) Illuminate\Contracts\Http\Kernel::class để tạo ra nhân xử lý ($kernel), trải qua một chuỗi quá trình phức tạp, $kernel sẽ được sinh ra 🌼

//Nếu bạn truy cập từ trình duyệt web (http): app\Http\Kernel.php được sinh ra, từ dòng lệnh console: app\Console\Kernel.php được sinh ra
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
//kernel thực hiện load tất cả các service providers ra được gọi trong $bootstrappers (vendor\laravel\framework\src\Illuminate\Foundation\Http\Kernel.php). Tất cả các service providers được cấu hình trong file config/app.php ở mảng $providers. Đầu tiên, hàm register() sẽ được gọi ở tất cả các providers, rồi sau đó, khi mà các providers đã được đăng kí đầy đủ, thì hàm boot sẽ được gọi.

//Service providers chịu trách nhiệm khởi tạo tất cả các thành phần khác nhau của framework, ví dụ như database, queue, validation, và routing
//Khi mà ứng dụng đã được khởi tạo và các service providers đã được đăng kí, Request sẽ được đưa xuống cho router
//Router sẽ thực hiện đưa các request này xuống một route hoặc controller để xử lý
$request = Illuminate\Http\Request::capture()
);
//Route hoặc controller xử lý trả về $response (vendor\symfony\http-foundation\Response.php) cho người dùng
$response->send();
//đóng, kết thúc
$kernel->terminate($request, $response);
