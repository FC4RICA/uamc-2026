<?php

namespace App\Policies;

use App\Models\SubmissionRevision;
use App\Models\User;

class SubmissionRevisionPolicy
{
    public function view(User $user, SubmissionRevision $submissionRevision): bool
    {
        return $submissionRevision->submission->submitted_by === $user->id;
    }

    public function upload(User $user, SubmissionRevision $submissionRevision): bool
    {
        return $submissionRevision->submission->submitted_by === $user->id
            && ! $submissionRevision->isResolved();
    }
}
