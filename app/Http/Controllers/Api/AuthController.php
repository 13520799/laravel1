<?php 

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Http\Model\User;
use App\Http\Model\Test;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    use AuthenticatesUsers;
    //use RegistersUsers;
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    public function index()
    {
        $this->resp('test', Response::HTTP_OK);
        return response()->json($this->resp, Response::HTTP_OK);
    }

    public function login()
    {
        //$this->validateLogin($request);
        $request = Request();
        $params = Request()->all();
        $this->validateLogin($request);
        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();
            $user->generateToken();

            return response()->json([
                'data' => $user->toArray(),
            ]);
        }

        return $this->sendFailedLoginResponse($request);
    }


    public function registered()
    {
        $request = Request();
        $params = Request()->all();
        //validate
        //$this->validator($request->all())->validate();
        $user = User::create([
            'name' => $params['name'],
            'email' => $params['email'],
            'password' => bcrypt($params['password']),
        ]);
        $this->guard()->login($user);
        $user->generateToken();

        return response()->json(['data' => $user->toArray()], 201);

        // $test = DB::table('test')->get();
        // $this->resp($test, Response::HTTP_OK);
        // return response()->json($this->resp, Response::HTTP_OK);
        
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
}