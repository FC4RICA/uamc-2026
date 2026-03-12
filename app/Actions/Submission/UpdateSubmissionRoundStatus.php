<?php

namespace App\Actions\Submission;

use App\Enums\SubmissionStatus;
use App\Mail\SubmissionRevisionRequestedMail;
use App\Models\SubmissionRevision;
use App\Models\SubmissionRound;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UpdateSubmissionRoundStatus
{
    public function handle(
        SubmissionRound $submissionRound, 
        SubmissionStatus $status,
        ?string $message = null,
        User $actor,
    ): void {
        match ($status) {
            SubmissionStatus::ACCEPTED => $this->accept($submissionRound),
            SubmissionStatus::REJECTED => $this->reject($submissionRound),
            SubmissionStatus::REVISE_REQUIRED  => $this->revise($submissionRound, $message, $actor),
            SubmissionStatus::PENDING  => $this->returnToPending($submissionRound),
        };
    }

    private function accept(SubmissionRound $submissionRound): void
    {
        $submissionRound->update([
            'status' => SubmissionStatus::ACCEPTED,
        ]);
    }

    private function reject(SubmissionRound $submissionRound): void
    {
        $submissionRound->update([
            'status' => SubmissionStatus::REJECTED,
        ]);
    }

    // TODO: make revision allow multiple files, or needed to be set expected file type changes
    private function revise(SubmissionRound $submissionRound, string $message, User $actor): void
    {
        DB::transaction(function () use ($submissionRound, $message, $actor) {
            $submissionRound->increment('current_revision_round');
            $submissionRound->update([
                'status' => SubmissionStatus::REVISE_REQUIRED,
            ]);

            $submissionRound->refresh();
            $submission = $submissionRound->submission;

            $revision = SubmissionRevision::create([
                'submission_round_id' => $submissionRound->id,
                'round' => $submissionRound->current_revision_round,
                'message' => $message,
                'target_email' => $submission->user->email,
                'requested_by' => $actor->id,
            ]);

            Mail::to($submission->user->email)
                ->queue(new SubmissionRevisionRequestedMail($submission, $revision));
        });
    }

    private function returnToPending(SubmissionRound $submissionRound): void
    {
        $submissionRound->update([
            'status' => SubmissionStatus::PENDING,
        ]);
    }
}