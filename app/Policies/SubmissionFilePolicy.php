<?php

namespace App\Policies;

use App\Models\SubmissionFile;
use App\Models\User;

class SubmissionFilePolicy
{
    public function download(User $user, SubmissionFile $submissionFile): bool
    {
        return $submissionFile->ownerId() === $user->id;
    }
}
