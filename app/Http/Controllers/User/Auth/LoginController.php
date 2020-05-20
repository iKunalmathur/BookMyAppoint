<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Model\user\User;
use Illuminate\Validation\ValidationException;

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
    protected $redirectTo = RouteServiceProvider::USERHOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
     //override funcations
     protected function credentials(Request $request)
     {
         $user = User::select('active')->where('email',$request->email)->first();
          if ($user) {
             if ($user->active == 0) {
                 return ['email'=>'inactive','password'=>'inactive'];
             }else{
                 return ['email'=>$request->email,'password'=>$request->password,'active'=>1];
             }
          }
          return $request->only($this->username(), 'password');
     }

     protected function sendFailedLoginResponse(Request $request)
     {
         $fields = $this->credentials($request);
         // dd($fields);
         if($fields['email'] == 'inactive'){
                 throw ValidationException::withMessages([
                  $this->username() => [trans('auth.inactive')],
                 ]);
         }else {
                 throw ValidationException::withMessages([
                  $this->username() => [trans('auth.failed')],
                 ]);
             }
     }
    public function __construct()
    {
        $this->middleware('guest:user')->except('logout');
    }
}
