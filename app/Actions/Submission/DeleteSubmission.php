<?php

namespace App\Actions\Submission;

use App\Enums\SubmissionStatus;
use App\Models\Submission;
use Illuminate\Support\Facades\DB;

class DeleteSubmission
{
    public function handle(Submission $submission): void
    {
        DB::transaction(function () use ($submission) {
            $submission->update([
                'status' => SubmissionStatus::DELETED,
            ]);

            $submission->delete(); // soft delete
        });

        // ArchiveSubmissionFolder::dispatch($submission);
    }
}