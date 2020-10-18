<?php namespace App\Http\Controllers\Site;

use App\User;
use App\Http\Requests\Site\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function __construct(User $user, Permission $permission, Role $role)
    {
        $this->module = "auth";
        $this->user = $user;
        $this->permission = $permission;
        $this->role = $role;

        $this->option = Cache::get('optionCache');
    }

    public function get_login()
    {
	    $module = $this->module;
	    if(Auth::user()){
            if(Auth::user()->hasRole('admin')){
                return redirect('admin/dashboard')->with('success', 'You are already logged in.');
            }else{
                return redirect('customer/dashboard')->with('success', 'You are already logged in.');
            }
	    }else{
	        return view('site.'.$module.'.login');
	    }
    }

    public function post_login(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->login_email,
            'password' => $request->login_pass,
        ];

        if (Auth::attempt($credentials)){
            $user = Auth::user();
            Session::put('user', $user);

            if($user->hasRole('admin')){
                return redirect('admin/dashboard')->with('success', 'Hello '.$user->name.' !');
            }elseif($user->hasRole('customer')){
                return redirect('customer/dashboard')->with('success', 'Hello '.$user->name.' !');
            }else{
                return redirect()->back()->with('error', 'Unautharized access.');
            }
        }else{
            return redirect()->back()->with('error', 'Email (or) password is invalid.');
        }
    }

    public function get_logout()
    {
        //CLEAR ALL SESSIONS
        Session::forget('user');
        Auth::logout();
        return redirect('login');
    }
}
