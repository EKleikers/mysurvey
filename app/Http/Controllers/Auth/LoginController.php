<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;

class LoginController extends Controller {
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
        $activeAppID = 100000046;
        include_once $_SERVER['DOCUMENT_ROOT'] . '/myadmin/resources/helpers/helper.php';
        $appsforceresponse = callAppsForceAPI($activeAppID, 'user');
        if ($appsforceresponse == null) {
            header('Location: /issue?message=Error accessing User APIs');
            die();
        }
        if ($appsforceresponse['code'] != '200') {
            header('Location: /login');
            die();
        }
        $username = $appsforceresponse['data']['username'];
        $password = $appsforceresponse['data']['password'];
        $email = $appsforceresponse['data']['email'];
        $language = $appsforceresponse['data']['language'];

        $roleresponse = callAppsForceAPI($activeAppID, 'user/role');
        if ($roleresponse == null) {
            header('Location: /issue?message=Error accessing User Role APIs');
            die();
        }
        if ($roleresponse['code'] != '200') {
            header('Location: /login');
            die();
        }
        $role = $roleresponse['data'];
        $user = User::where('email', $email)->first();
        if ($user) {
            $request = [
                'id' => $appsforceresponse['data']['id'],
                'email' => $email,
                'name' => $appsforceresponse['data']['firstname'] . ' ' . $appsforceresponse['data']['lastname'],
                'role' => $role
            ];
            \Auth::login($user); // login user automatically
            $user = \Auth::user();
            $user->update($request);
            session()->put('locale', $language);
            return redirect('/');
        } else {
            $request = [
                'id' => $appsforceresponse['data']['id'],
                'email' => $email,
                'enable' => '1',
                'name' => $appsforceresponse['data']['firstname'] . ' ' . $appsforceresponse['data']['lastname'],
                'password' => $password,
                'password_confirmation' => $password,
                'email_verified_at' => now(),
                'role' => $role
            ];
            $user = User::create($request);
            \Auth::login($user); // login user automatically
            session()->put('locale', $language);
            return redirect('/');
        }
    }
}
