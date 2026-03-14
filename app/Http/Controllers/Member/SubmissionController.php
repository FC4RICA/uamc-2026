<?php

namespace App\Http\Controllers\Member;

use App\Actions\Submission\CreateAbstractSubmission;
use App\Actions\Submission\CreateFinalSubmission;
use App\Actions\Submission\DeleteSubmission;
use App\Actions\Submission\UpdateAbstractSubmission;
use App\Actions\Submission\UpdateFinalSubmission;
use App\Actions\Submission\UploadRevisionAbstract;
use App\Contracts\CloudStorage;
use App\Data\Submission\CreateAbstractSubmissionData;
use App\Data\Submission\UpdateAbstractSubmissionData;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAbstractSubmissionRequest;
use App\Http\Requests\CreateFinalSubmissionRequest;
use App\Http\Requests\UpdateAbstractSubmissionRequest;
use App\Http\Requests\UpdateFinalSubmissionRequest;
use App\Models\AbstractGroup;
use App\Models\Submission;
use App\Models\SubmissionFile;
use App\Models\SubmissionRevision;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        return view('member.submission.index', compact('submission', 'user'));
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

        return redirect()->route('member.index');
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

    public function abstractRevision(
        SubmissionRevision $revision,
    ): View {
        Gate::authorize('view', $revision);

        return view('member.submission.revision', compact('revision'));
    }

    public function uploadRevision(
        Request $request,
        SubmissionRevision $revision,
        UploadRevisionAbstract $action,
    ): RedirectResponse {
        Gate::authorize('upload', $revision);

         $validated = $request->validate([
            'abstract' => ['required', 'file', 'mimes:pdf', 'max:51200'],
        ]);

        $action->handle($revision, $validated['abstract']);

        return back();
    }

   public function indexFinal(): View
   {
        $user = Auth::user();
        $submission = $user->submission;
        $finalRound = $submission->finalRound();

        Gate::authorize('viewFinal', $submission);

        return view('member.submission.final', compact('user', 'submission', 'finalRound'));
   }

   public function storeFinal(
        CreateFinalSubmissionRequest $request,
        CreateFinalSubmission $action,
   ): RedirectResponse {
        $submission = Auth::user()->submission;

        $action->handle(
            submission: $submission,
            recommendation: $request->file('recommendation_letter'),
            publicationConsent: $request->file('publication_consent'),
            extendedAbstract: $request->file('extended_abstract'),
            poster: $request->file('poster'),
        );

        return back();
   }

   public function updateFinal(
        UpdateFinalSubmissionRequest $request,
        UpdateFinalSubmission $action,
   ): RedirectResponse {
        $submission = Auth::user()->submission;

        $action->handle(
            submission: $submission,
            recommendation: $request->file('recommendation_letter'),
            publicationConsent: $request->file('publication_consent'),
            extendedAbstract: $request->file('extended_abstract'),
            poster: $request->file('poster'),
        );

        return back();
   }
}
