<?php

namespace App\Http\Controllers;

use App\Actions\Submission\CreateAbstractSubmission;
use App\Data\AbstractSubmissionData;
use App\Http\Requests\AbstractSubmissionRequest;
use App\Models\AbstractGroup;
use App\Models\Submission;
use Illuminate\Database\QueryException;
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

    public function store(
        AbstractSubmissionRequest $request,
        CreateAbstractSubmission $action,
    ): RedirectResponse
    {
        Gate::authorize('create', Submission::class);

        try {
            $action->handle(
                AbstractSubmissionData::fromRequest($request)
            );

            return back()->with('success', 'Created');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') { // duplicate key
                return back()->withErrors([
                    'submission' => 'Submission already submitted.',
                ]);
            }
            throw $e;
        }
    }

    public function index(): View
    {
        Gate::authorize('index', Submission::class);

        $user = Auth::user();

        return view('member.submission', compact('user'));
    }
}
