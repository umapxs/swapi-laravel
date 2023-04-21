<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use PragmaRX\Google2FA\Google2FA;
use App\Models\User;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register and 2FA', function () {

    // Create a new user
    $user = User::factory()->create();

    $response = $this->post('/register', [
        'name' => $user->name,
        'email' => $user->email,
        'password' => $user->password,
        'password_confirmation' => $user->password,
    ]);

    $response->assertRedirect();

    // Check that the user has been created
    $this->assertDatabaseHas('users', [
        'email' => $user->email,
    ]);

    // Generate a secret key for the user
    $google2fa = new Google2FA();
    $google2fa_secret = $google2fa->generateSecretKey();

    // Save the secret key to the database
    DB::table('users')
            ->where('email', $user->email)
            ->update(['google2fa_secret' => $google2fa_secret]);

    // Get the QR code URL for the secret key
    $qrCodeUrl = $google2fa->getQRCodeUrl(
        config('app.name'),
        $user->email,
        $google2fa_secret,
    );

    // Check if the URL exists and returns a valid response
    $response = $this->actingAs($user)
                     ->get(route('complete-registration'));

    $response->assertRedirect();

    $response = $this->actingAs($user)
                     ->get(route('complete-registration'), [
                         '_token' => csrf_token(),
                         'one_time_code' => $google2fa->getCurrentOtp($google2fa_secret),
                     ]);

    $this->assertAuthenticatedAs($user);
    $response->assertRedirect();
    $response->assertRedirect(RouteServiceProvider::HOME);
});
