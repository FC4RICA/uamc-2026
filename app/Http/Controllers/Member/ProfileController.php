<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Enums\AcademicTitle;
use App\Enums\Education;
use App\Enums\ParticipationType;
use App\Enums\PresentationType;
use App\Enums\Title;
use App\Http\Requests\ProfileRequest;
use App\Models\Occupation;
use App\Models\Organization;

class ProfileController extends Controller
{
    public function edit(): View
    {
        $user = Auth::user();
        $profile = $user->profile;

        $titles = Title::cases();
        $academicTitles = AcademicTitle::cases();
        $education = Education::cases();
        $participationType = ParticipationType::cases();
        $presentationType = PresentationType::cases();
        $organizations = Organization::all();
        $occupations = Occupation::all();

        return view('member.profile', compact(
            'user', 'profile', 'titles', 'academicTitles', 'education',
            'participationType', 'presentationType', 'organizations', 'occupations'
        ));
    }

    public function update(ProfileRequest $request)
    {
        Auth::user()->profile->update($request->validated());

        return back()->with('status', 'Profile updated successfully.');
    }
}
