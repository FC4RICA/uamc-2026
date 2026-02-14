<?php

namespace App\Actions\Submission;

use App\Enums\SubmissionStatus;
use App\Mail\SubmissionReviseRequestedMail;
use App\Models\Submission;
use App\Models\SubmissionRevise;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UpdateSubmissionStatus
{
    public function handle(
        Submission $submission, 
        SubmissionStatus $status,
        ?string $message = null,
        User $actor,
    ): void {
        match ($status) {
            SubmissionStatus::ACCEPTED => $this->accept($submission),
            SubmissionStatus::REJECTED => $this->reject($submission),
            SubmissionStatus::REVISE_REQUIRED  => $this->revise($submission, $message, $actor),
            SubmissionStatus::PENDING  => $this->returnToPending($submission),
        };
    }

    private function accept(Submission $submission): void
    {
        $submission->update([
            'status' => SubmissionStatus::ACCEPTED,
        ]);
    }

    private function reject(Submission $submission): void
    {
        $submission->update([
            'status' => SubmissionStatus::REJECTED,
        ]);
    }

    private function revise(Submission $submission, string $message, User $actor): void
    {
        DB::transaction(function () use ($submission, $message, $actor) {
            $submission->increment('current_revision_round');
            $submission->update([
                'status' => SubmissionStatus::REVISE_REQUIRED,
                'current_revision_round' => $submission->current_revision_round + 1,
            ]);

            $submission->refresh();

            $revision = SubmissionRevise::create([
                'submission_id' => $submission->id,
                'round' => $submission->current_revision_round,
                'message' => $message,
                'target_email' => $submission->user->email,
                'requested_by' => $actor->id,
            ]);

            Mail::to($submission->user->email)
                ->queue(new SubmissionReviseRequestedMail($submission, $revision));
        });
    }

    private function returnToPending(Submission $submission): void
    {
        $submission->update([
            'status' => SubmissionStatus::PENDING,
        ]);
    }
}