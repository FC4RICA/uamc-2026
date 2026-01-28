<?php

namespace App\Http\Controllers\Member;

use App\Actions\Submission\CreateAbstractSubmission;
use App\Contracts\CloudStorage;
use App\Data\AbstractSubmissionData;
use App\Http\Controllers\Controller;
use App\Http\Requests\AbstractSubmissionRequest;
use App\Models\AbstractGroup;
use App\Models\Submission;
use App\Models\SubmissionFile;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\View\View;

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

    public function edit(): View
    {
        $user = Auth::user();
        $groups = AbstractGroup::all();
        $submission = $user->submission;

        return view(
            'member.submission.edit',
            compact('user', 'groups', 'submission')
        );
    }

    public function update(): RedirectResponse
    {
        return back()->with('status', 'Submission updated successfully.');
    }

    public function delete(): RedirectResponse
    {
        return redirect(route('member.index'));
    }

    public function fileDownload(
        SubmissionFile $file,
        CloudStorage $storage
    ): StreamedResponse
    {
        Gate::authorize('download', $file);

        $stream = $storage->download($file->drive_file_id);

        return response()->streamDownload(
            function () use ($stream) {
                while (!$stream->eof()) {
                    echo $stream->read(8192);
                }
            },
            $file->original_file_name
        );
    }
}
