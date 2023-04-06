<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use PragmaRX\Google2FA\Google2FA;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        // validate the request
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Initialise the 2FA class
        $google2fa = app('pragmarx.google2fa');

        // Save the registration data in an array
        $registrationData = $request->all();

        // Add the secret key to the registration data
        $registrationData["google2fa_secret"] = $google2fa->generateSecretKey();

        // Save the registration data to the user session for just the next request
        $request->session()->flash('registrationData', $registrationData);

        // Generate the QR image. This is the image the user will scan with their app
        // to set up two factor authentication
        $QR_Image = $google2fa->getQRCodeInline(
            config('app.name'),
            $registrationData['email'],
            $registrationData['google2fa_secret']
        );

        // Pass the QR barcode image to our view
        return view('auth.google2fa.register', ['QR_Image' => $QR_Image, 'secret' => $registrationData['google2fa_secret']]);


    }

    public function store(Request $request): RedirectResponse
    {
        // validate the request
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // generate a secret key for the user
        $google2fa = app('pragmarx.google2fa');
        $secret = $google2fa->generateSecretKey();

        // save the secret key for the user
        $user->google2fa_secret = $secret;
        $user->save();

        // enable two-factor authentication for the user
        $user->google2fa_enable = true;
        $user->save();

        // log in the user
        Auth::login($user);

        // redirect the user to the home page
        return redirect(RouteServiceProvider::HOME);
    }

    public function completeRegistration(Request $request)
    {
        // add the session data back to the request input
        $request->merge(session('registrationData'));

        // Call the default laravel authentication
        return $this->store($request);
    }

}
