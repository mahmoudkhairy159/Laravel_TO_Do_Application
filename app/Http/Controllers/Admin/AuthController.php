<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\UserLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    protected $_config;

    public function __construct()
    {
        $this->_config = request('_config');
    }

    public function login()
    {
        $pageConfigs = ['myLayout' => 'blank', 'myRTLSupport' => false];
        return view($this->_config['view'], ['pageConfigs' => $pageConfigs]);
    }

    public function checkLogin(UserLoginRequest $request)
    {
        $remember_token = $request->remember_token == "on" ? 1 : false;
        $credentials = ['email' => $request->email, 'password' => $request->password];

        if (auth()->attempt($credentials, $remember_token)) {
            $user = auth()->user();
            if ($user->status == 1 && $user->blocked == 0) {
                Auth::logoutOtherDevices($request->get('password'));
                return redirect("/admin")->with('success', trans("global.success_login"));
            } else {
                auth()->logout();
                $request->flash();
                return redirect()->route("admin.login")->withInput()->withErrors([
                    'email' => 'Email is Blocked Or Inactive',
                ]);
            }
        } else {
            $request->flash();
            return redirect()->route("admin.login")->withInput()->withErrors([
                'email' => 'Error Email or Password',
                'password' => 'Error Email or Password',
            ]);
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->put('success', trans("global.success_logout"));
        return redirect()->route('admin.login');
    }
}
