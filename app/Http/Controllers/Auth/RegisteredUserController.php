<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ActivityLogsController;
use App\Mail\Mailable;
use App\Mail\Google2FACode;
use Illuminate\View\View;
use PragmaRX\Google2FA\Google2FA;

class RegisteredUserController extends Controller
{
    use RegistersUsers {
        register as registration;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $activityLogsController;

    public function __construct(ActivityLogsController $activityLogsController)
    {
        $this->middleware('guest');
        $this->activityLogsController = $activityLogsController;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(Request $request)
    {
        return view('auth.register');
    }

    /**
     * Display the registration view.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $google2fa = app('pragmarx.google2fa');

        $registration_data = $request->all();

        $registration_data["google2fa_secret"] = $google2fa->generateSecretKey();
        $request->session()->put('registration_data', $registration_data);

        $QR_Image = $google2fa->getQRCodeInline(
            config('app.name'),
            $registration_data['email'],
            $registration_data['google2fa_secret']
        );

        $secret = $registration_data['google2fa_secret'];

        return view('auth.google2fa.register', compact('data', 'QR_Image', 'secret'));
    }

    public function completeRegistration(Request $request): RedirectResponse
    {
        $registration_data = $request->session()->get('registration_data');

        $user =  User::create([
            'name' => $registration_data['name'],
            'email' => $registration_data['email'],
            'password' => Hash::make($registration_data['password']),
            'google2fa_secret' => $registration_data['google2fa_secret'],
        ]);

        event(new Registered($user));

        // log info
        $this->activityLogsController->log('Profile', 'Register');

        Auth::login($user);

        // log info
        $this->activityLogsController->log('Profile', 'Login');

        return redirect(RouteServiceProvider::HOME);
    }

    public function sendGoogle2FACode(Request $request): RedirectResponse
    {
        $registration_data = $request->session()->get('registration_data');
        $secret = $registration_data['google2fa_secret'];
        $email = $registration_data['email'];

        $google2fa = new Google2FA();
        $email2fa = $google2fa->getCurrentOtp($secret);
        // $email2fa = $google2fa->getCurrentOtp($user->google2fa_secret);

        Mail::to($email)->send(new Google2FACode($email2fa));

        return redirect()->route('google2fa.token');
    }
}