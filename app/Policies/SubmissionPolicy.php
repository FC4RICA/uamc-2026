<?php

namespace App\Policies;

use App\Enums\SubmissionStatus;
use App\Models\Submission;
use App\Models\User;

class SubmissionPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Submission $submission): bool
    {
        return $user->id === $submission->submitted_by;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->canSubmitAbstract();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Submission $submission): bool
    {
        return $user->id === $submission->submitted_by;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Submission $submission): bool
    {
        return $user->id === $submission->submitted_by 
            && ! $submission->trashed();
    }

    public function updateStatus(User $user, Submission $submission, SubmissionStatus $target): bool
    {
        if (! $user->is_admin) {
            return false;
        }

        return $submission->status->canTransitionTo($target);
    }
}
