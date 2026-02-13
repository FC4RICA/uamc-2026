<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AcademicTitle;
use App\Enums\Education;
use App\Enums\ParticipationType;
use App\Enums\PresentationType;
use App\Enums\Title;
use App\Http\Controllers\Controller;
use App\Models\Occupation;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::with('profile')
            ->filter($request->only([
                'participationType', 
                'presentationType', 
                'submission', 
                'payment', 
                'role'
            ]))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.user.index', compact('users'));
    }

    public function edit(User $user)
    {
        $profile = $user->profile;

        $titles = Title::cases();
        $academicTitles = AcademicTitle::cases();
        $education = Education::cases();
        $participationType = ParticipationType::cases();
        $presentationType = PresentationType::cases();
        $organizations = Organization::all();
        $occupations = Occupation::all();

        return view('admin.user.edit', compact(
            'user', 'profile', 'titles', 'academicTitles', 'education',
            'participationType', 'presentationType', 'organizations', 'occupations'
        ));
    }

    public function updateEmail(Request $request, User $user): RedirectResponse
    {
        if ($request['email'] === $user->email) return back();

        $validated = $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->update([
            'email' => $validated['email']
        ]);

        return back()->with('success', 'Email updated successfully.');
    }

    public function delete(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('admin.user.index');
    }
}
