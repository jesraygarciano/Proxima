<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */

    // protected $redirectTo = '/'; // 追加。登録後やログイン後のリダイレクト先

    protected $redirectTo = '/'; // 追加。登録後やログイン後のリダイレクト先

    // @if( Auth::user()->role == 0 )
    //     protected $redirectTo = '/opening'; // 追加。登録後やログイン後のリダイレクト先
    // @else if( Auth::user()->role == 1 )
    //     protected $redirectTo = '/companies'; // 追加。登録後やログイン後のリダイレクト先
    // @endif

    public function __construct()
    {
        $this->middleware('guest', ['except' => ['verify_account', 'getLogout']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'f_name' => 'required|max:255',
            // 'l_name' => 'required|max:255',
            // 'm_name' => 'max:255',
            // 'birth_date' => 'required',
            'role' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    // protected function getRegister($status)
    // {
    //     // $status = 2;
    // }

    protected function judge($status)
    {
        return view('auth.register', compact('status'));
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $verify_token = md5(uniqid(rand(), true));

        $user = User::create([
            // 'f_name' => $data['f_name'],
            // 'l_name' => $data['l_name'],
            // 'm_name' => $data['m_name'],
            // 'birth_date' => $data['birth_date'],
            'role' => $data['role'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'verify_token'=>$verify_token
        ]);

        // send verification email

        // Mail::send('emails.verify-email', ['user'=>$user], function ($message) use ($user){
        //     $message->from(env('MAIL_USERNAME'), 'Nexseed Support');
        //     $message->subject('Account Verification');
        //     $message->to($user->email);
        // });

        return $user;
    }

    public function verify_account(Request $request){

        $user = \App\User::where('verify_token',$request->verify_token)->first();
        $user->verify_token = '';
        $user->save();
        return 'Thank you!<br>Your account is now verified.<br><a href="'.url('/').'">Proceed>>></a>';
    }
}
