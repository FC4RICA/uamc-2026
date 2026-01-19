<?php

namespace App\Http\Controllers;

use App\Models\AbstractGroup;
use App\Models\Submission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View as View;

class SubmissionController extends Controller
{
    public function create(): View
    {
        Gate::authorize('create', Submission::class);

        // Submission
        $user = Auth::user();
        $profile = $user->profile;
        $groups = AbstractGroup::all();
        $user_presentation_type = $profile->presentation_type;
        $participants = [];

        return view('member.submission.create', 
            compact('user', 'groups', 'user_presentation_type', 'profile', 'participants'));
    }

    public function store(): RedirectResponse
    {
        Gate::authorize('store', Submission::class);

        $user = Auth::user();

        return redirect(route('member.submission.index'));
    }

    public function index(): View
    {
        Gate::authorize('index', Submission::class);

        $user = Auth::user();

        return view('member.submission', compact('user'));
    }
}
