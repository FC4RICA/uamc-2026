<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Submission\DeleteSubmission;
use App\Actions\Submission\UpdateAbstractSubmission;
use App\Contracts\CloudStorage;
use App\Data\Submission\UpdateAbstractSubmissionData;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAbstractSubmissionRequest;
use App\Models\AbstractGroup;
use App\Models\Submission;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SubmissionController extends Controller
{
    public function index(): View
    {
        $submissions = Submission::active()
            ->with([
                'user.profile',
                'abstractGroups',
            ])
            ->get();

        return view('admin.submission.index', compact('submissions'));
    }

    public function view(Submission $submission): View
    {
        return view('admin.submission.view', compact('submission'));
    }

    public function edit(Submission $submission): View
    {
        $groups = AbstractGroup::all();

        return view('admin.submission.edit', compact('groups', 'submission'));
    }

    public function update(
        Submission $submission,
        UpdateAbstractSubmissionRequest $request,
        UpdateAbstractSubmission $action
    ): RedirectResponse {
        $action->handle($submission, UpdateAbstractSubmissionData::fromRequest($request));
        
        return back()->with('status', 'Submission updated successfully.');
    }

    public function folder(
        Submission $submission, 
        CloudStorage $storage
    ): RedirectResponse {
        if (! $submission->drive_folder_id) {
            abort(404, 'Submission folder not found.');
        }

        $folder = $storage->getFileInfo($submission->drive_folder_id);

        if (empty($folder['view_url'])) {
            abort(404, 'Folder link unavailable.');
        }

        return redirect()->away($folder['view_url']);
    }

    public function delete(
        Submission $submission,
        DeleteSubmission $action,
    ): RedirectResponse
    {
        $action->handle($submission);
        return redirect(route('admin.submission.index'));
    }
}
