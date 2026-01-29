<?php

namespace App\Http\Controllers\Member;

use App\Actions\Submission\CreateAbstractSubmission;
use App\Actions\Submission\DeleteSubmission;
use App\Actions\Submission\UpdateAbstractSubmission;
use App\Contracts\CloudStorage;
use App\Data\Submission\CreateAbstractSubmissionData;
use App\Data\Submission\UpdateAbstractSubmissionData;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAbstractSubmissionRequest;
use App\Http\Requests\UpdateAbstractSubmissionRequest;
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
    public function createAbstract(): View
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

    public function storeAbstract(
        CreateAbstractSubmissionRequest $request,
        CreateAbstractSubmission $action,
    ): RedirectResponse
    {
        Gate::authorize('create', Submission::class);

        try {
            $action->handle(
                CreateAbstractSubmissionData::fromRequest($request)
            );

            return redirect(route('member.index'), 201);
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') { // duplicate key
                return back()->withErrors([
                    'submission' => 'Submission already submitted.',
                ]);
            }
            throw $e;
        }
    }

    public function indexAbstract(): View
    {
        $user = Auth::user();
        $submission = $user->submission;
        Gate::authorize('view', $submission);
        return view('member.submission.index', compact('submission'));
    }

    public function editAbstract(): View
    {
        $user = Auth::user();
        $submission = $user->submission;
        Gate::authorize('update', $submission);

        $groups = AbstractGroup::all();

        return view(
            'member.submission.edit',
            compact('user', 'groups', 'submission')
        );
    }

    public function updateAbstract(
        UpdateAbstractSubmissionRequest $request,
        UpdateAbstractSubmission $action
    ): RedirectResponse
    {
        $user = Auth::user();
        $submission = $user->submission;
        Gate::authorize('update', $submission);

        $action->handle($submission, UpdateAbstractSubmissionData::fromRequest($request));
        
        return back()->with('status', 'Submission updated successfully.');
    }

    public function delete(
        DeleteSubmission $action,
    ): RedirectResponse
    {
        $user = Auth::user();
        $submission = $user->submission;
        Gate::authorize('delete', $submission);

        $action->handle($submission);

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
