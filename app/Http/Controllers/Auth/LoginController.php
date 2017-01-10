<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function redirectToProvider($social)
    {
        return Socialite::driver($social)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */

    public function handleProviderCallback($social)
    {
        $user = Socialite::driver($social)->user();
        $checkUser = User::where('email', $user->getEmail())->first();
        if ($checkUser) {
            Auth::login($checkUser);
            return redirect()->action('HomeController@index');
        }

        $result = User::create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'avatar' => 'default-avatar.png',
            'role' => config('common.auth.role_default'),
            'password'=> uniqid(rand(), true),
        ]);
        
        Auth::login($result);
        return redirect()->action('HomeController@index');
    }
}
