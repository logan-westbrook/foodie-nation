<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\ProfilePasswordUpdateRequest;
use App\Http\Requests\Admin\Profile\ProfileUpdateRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(): View
    {
        return view('admin.profile.index');
    }

    public function updateProfile(ProfileUpdateRequest $request): RedirectResponse
    {
        Auth::user()->updateUserSettingsFromRequest($request);
        toastr('Updated Successfully!!!');

        return redirect()->back();
    }

    public function updatePassword(ProfilePasswordUpdateRequest $request): RedirectResponse
    {
        Auth::user()->updateUserPasswordFromRequest($request);
        toastr('Updated Successfully!!!');

        return redirect()->back();
    }
}
