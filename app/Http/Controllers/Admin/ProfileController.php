<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AcademicTitle;
use App\Enums\Education;
use App\Enums\ParticipationType;
use App\Enums\PresentationType;
use App\Enums\Title;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Occupation;
use App\Models\Organization;
use App\Models\Profile;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request): View
    {
        $profiles = Profile::realParticipants()
            ->with([
                'organization', 
                'user.payments', 
                'submissions'
            ])
            ->filter($request->only([
                'participationType', 
                'presentationType', 
                'payment', 
                'search'
            ]))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.profile.index', compact('profiles'));
    }

    public function edit(Profile $profile)
    {
        $user = $profile->creator;

        $titles = Title::cases();
        $academicTitles = AcademicTitle::cases();
        $education = Education::cases();
        $participationType = ParticipationType::cases();
        $presentationType = PresentationType::cases();
        $organizations = Organization::all();
        $occupations = Occupation::all();

        return view('admin.profile.edit', compact(
            'user', 'profile', 'titles', 'academicTitles', 'education',
            'participationType', 'presentationType', 'organizations', 'occupations'
        ));
    }

    public function update(ProfileRequest $request, Profile $profile): RedirectResponse
    {
        $profile->update($request->validated());

        return back()->with('status', 'Profile updated successfully.');
    }
}