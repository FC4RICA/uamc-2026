<?php

namespace App\Actions\Submission;

use App\Contracts\CloudStorage;
use App\Data\AbstractSubmissionData;
use App\Enums\ParticipationType;
use App\Enums\PresentationType;
use App\Enums\SubmissionFileType;
use App\Enums\SubmissionRoundType;
use App\Enums\SubmissionStatus;
use App\Models\Profile;
use App\Models\Submission;
use App\Models\SubmissionFile;
use App\Models\SubmissionRound;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/*
CreateSubmission handle the creation of the submission, participants profile,
create gdrive submission folder and upload files.

Along with catch to delete a folder if the action is failed.

It create a folder and upload file to gdrive first, then store records in db within transaction
*/
class CreateAbstractSubmission
{
    public function __construct(
        protected CloudStorage $storage
    ) {}

    public function handle(AbstractSubmissionData $data): void
    {
        $driveFolderId = null;

        try {
            $user = User::with('profile')->findOrFail($data->userId);

            $submissionId = Str::uuid()->toString();

            $folderId = $this->storage->makePath(
                "abstract_submissions/{$user->presentationType()->initial()}_{$user->profile->firstname}-{$user->profile->lastname}_{$submissionId}"
            );

            $info = pathinfo($data->abstract->getClientOriginalName());
            $fileId = $this->storage->uploadToFolder(
                parentId: $folderId,
                file: $data->abstract,
                fileName: $info['filename'] . '_v1.' . $info['extension'],
            );

            DB::transaction(function () use ($data, $user, $folderId, $fileId) {
                $submission = $this->createSubmission($data, $user, $folderId);

                $abstract_round = $this->createSubmissionAbstractRound($submission);
                $this->createAbstractFile($data->abstract, $fileId, $abstract_round->id);
                
                $pivotData = [];
                foreach ($data->groups as $priority => $groupId) {
                    $pivotData[$groupId] = ['priority' => $priority];
                }
                $submission->abstractGroups()->sync($pivotData);

                $profileIds = $this->createProfiles($data->participants, $user->presentationType(), $user->id);
                $profileIds[] = $user->profile->id;

                $submission->profiles()->sync($profileIds);
            });

            
        } catch (\Throwable $e) {
            if ($driveFolderId) {
                try {
                    // $this->storage->delete($driveFolderId);
                } catch (\Throwable $cleanupError) {
                    Log::error('Failed to cleanup Drive folder', [
                        'folder_id' => $driveFolderId,
                        'exception' => $cleanupError,
                    ]);
                }
            }

            throw $e;
        }
    }

    private function createSubmission(AbstractSubmissionData $data, User $user, string $folderId): Submission
    {
        return Submission::create([
            'submitted_by' => $data->userId,
            'presentation_type' => $user->presentationType(),
            'title_th' => $data->titleTH,
            'title_en' => $data->titleEN,
            'keywords' => $data->keyword,
            'status' => SubmissionStatus::PENDING,
            'drive_folder_id' => $folderId,
        ]);
    }

    private function createSubmissionAbstractRound(Submission $submission): SubmissionRound
    {
        return SubmissionRound::create([
            'submission_id' => $submission->id,
            'round_type' => SubmissionRoundType::ABSTRACT,
        ]);
    }

    private function createAbstractFile(UploadedFile $file, string $drive_file_id, string $submission_round_id): void
    {
        SubmissionFile::create([
            'submission_round_id' => $submission_round_id,
            'file_type' => SubmissionFileType::ABSTRACT,
            'drive_file_id' => $drive_file_id,
            'original_file_name' => $file->getClientOriginalName(),
        ]);
        return;
    }

    private function createProfiles(array $participants, PresentationType $type, string $userId): array
    {
        $profileIds = [];
        foreach ($participants as $participant) {
            $profile = Profile::create([
                ...$participant,
                'participation_type' => ParticipationType::PRESENTER,
                'presentation_type' => $type,
                'created_by' => $userId,
            ]);

            $profileIds[] = $profile->id;
        }
        return $profileIds;
    }
}
