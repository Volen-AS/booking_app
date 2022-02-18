<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegistrationRequest;
use App\Jobs\VerifyEmailJob;
use App\Mails\EmailNotificationMail;
use App\Models\VerifyUser;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Ramsey\Uuid\Rfc4122\UuidV4;
use Ramsey\Uuid\Uuid;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @param  \App\Http\Requests\UserRegistrationRequest  $request
     *
     * @return mixed
     */
    public function register(UserRegistrationRequest $request)
    {
        $user = new User();

        $user->first_name = ucfirst($request->get('first_name'));
        $user->middle_name = ucfirst($request->get('middle_name'));
        $user->last_name = ucfirst($request->get('last_name'));
        $user->birth_date = $request->get('birth_date');
        $user->phone = $request->get('phone');
        $user->email = $request->get('email');
        $user->save();

        $this->dispatch(new VerifyEmailJob($user));

        //TODO: trans('') for message when will implement multilanguage
        return redirect()->route('welcome')
            ->with('success', "Your account was successfully created. Please check your email");
    }
}
