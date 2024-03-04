<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ProfilePasswordUpdateRequest;
use App\Http\Requests\Frontend\ProfileUpdateRequest;
use App\Http\Requests\ProfileAvatarRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function updateProfile(ProfileUpdateRequest $request): RedirectResponse
    {
        Auth::user()->updateUserSettingsFromRequest($request);
        toastr()->success('Profile Updated Successfully!!');

        return redirect()->back();
    }

    public function updatePassword(ProfilePasswordUpdateRequest $request): RedirectResponse
    {
        Auth::user()->updateUserPasswordFromRequest($request);
        toastr()->success('Password Updated Successfully!!');

        return redirect()->back();
    }

    public function updateAvatar(ProfileAvatarRequest $request): Response
    {
        Auth::user()->updateUserSettingsFromRequest($request);
        toastr()->success('Avatar Updated Successfully!!');

        return response([ 'status' => 'success', 'message' => 'Avatar Updated Successfully' ]);
    }
}
