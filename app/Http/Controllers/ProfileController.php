<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Model;
use Yoeunes\Toastr\Toastr;

class ProfileController extends Controller
{
    protected $activityLogsController;

    public function __construct(ActivityLogsController $activityLogsController)
    {
        $this->activityLogsController = $activityLogsController;
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // log info
        $this->activityLogsController->log('Profile', 'Edit');

        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        // log info
        $this->activityLogsController->log('Profile', 'Update');

        if($request->user()->wasChanged() || $request->user()->wasRecentlyCreated) {
            toastr()->success('Your profile has been updated successfully', 'Success');

            return redirect('/profile');
        }

        toastr()->error('Oops, something went wrong', 'Error');

        return back();

    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // log info
        $this->activityLogsController->log('Profile', 'Destroy');

        if(!$user->exists) {
            toastr()->success('Your account has been deleted successfully', 'Success');

            return redirect('/');
        }

        toastr()->error('Oops, something went wrong', 'Error');

        return back();

    }

    public function destroy2fa(Request $request): RedirectResponse
    {
        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // log info
        $this->activityLogsController->log('Profile', 'Destroy2fa');

        if(!$user->exists) {
            toastr()->success('Your account has been deleted successfully', 'Success');

            return redirect('/');
        }

        toastr()->error('Oops, something went wrong', 'Error');

        return back();
    }
}
