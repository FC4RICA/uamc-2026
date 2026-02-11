<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Submission\DeleteSubmission;
use App\Actions\Submission\UpdateAbstractSubmission;
use App\Actions\Submission\UpdateSubmissionStatus;
use App\Contracts\CloudStorage;
use App\Data\Submission\UpdateAbstractSubmissionData;
use App\Enums\SubmissionStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAbstractSubmissionRequest;
use App\Http\Requests\UpdateSubmissionStatusRequest;
use App\Models\AbstractGroup;
use App\Models\Submission;
use App\Models\SubmissionRevise;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SubmissionController extends Controller
{
    public function index(Request $request): View
    {
        $submissions = Submission::active()
            ->with([
                'user.profile',
                'abstractGroups',
            ])
            ->filter($request->only(['status', 'group', 'search']))
            ->latest()
            ->paginate(15)
            ->withQueryString();
        
        $abstractGroups = AbstractGroup::orderBy('id')->get();

        return view('admin.submission.index', compact('submissions', 'abstractGroups'));
    }

    public function view(Submission $submission): View
    {
        $previewRevision = new SubmissionRevise([
            'message' => old('message') ?? '- กรุณาแก้ไขบทคัดย่อให้สอดคล้องกับหัวข้อ',
        ]);

        return view('admin.submission.show', compact('submission', 'previewRevision'));
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

    public function updateStatus(
        Submission $submission,
        UpdateSubmissionStatusRequest $request,
        UpdateSubmissionStatus $action,
    ): RedirectResponse {
        Gate::authorize('updateStatus', [
            $submission,
            SubmissionStatus::from($request->status),
        ]);

        $action->handle(
            $submission, 
            SubmissionStatus::from($request->validated('status')),
            $request->validated('message'),
            Auth::user(),
        );

        return back()->with('status', 'Submission status updated successfully.');
    }
}
