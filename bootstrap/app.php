<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

//Một biến $app được khởi tạo từ vendor\laravel\framework\src\Illuminate\Foundation\Application.php, __construct trong Application sẽ chạy gồm có
//setBasePath: tạo ra global các đường dẫn app_path(), base_path(), config_path(), database_path(), public_path(),  resource_path(), storage_path(), ...
//registerBaseBindings: khởi tạo container để chứa các dependencies trong ứng dụng
//registerBaseServiceProviders: tiến hành đăng ký các service cơ bản
//registerCoreContainerAliases: đăng ký các bí danh cho Core Container
//define('ROOT_PATH', realpath(__DIR__.'/../'));
$app = new Illuminate\Foundation\Application(
    __DIR__.'/../'
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/
//tiến hành ràng buộc một số Interfaces (giao diện) quan trọng vào container (vùng chứa) để dùng khi cần
//app\Http\Kernel.php kế thừa từ vendor\laravel\framework\src\Illuminate\Foundation\Http\Kernel.php và kernel tiến hành nạp thông tin middleware và các bootstrappers chuẩn bị được kích hoạt ở bước sau
$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
