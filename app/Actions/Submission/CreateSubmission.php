<?php

namespace App\Actions\Submission;

use App\Contracts\CloudStorage;
use App\Data\SubmissionData;
use App\Enums\ParticipationType;
use App\Enums\PresentationType;
use App\Enums\SubmissionStatus;
use App\Models\Profile;
use App\Models\Submission;
use App\Models\SubmissionFile;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/*
CreateSubmission handle the creation of the submission, participants profile,
create gdrive submission folder and upload files.

Along with catch to delete a folder if the action is failed.
*/
class CreateSubmission
{
    public function __construct(
        protected CloudStorage $storage
    ) {}

    public function handle(SubmissionData $data): void
    {
        $driveFolderId = null;

        try {
            $user = User::with('profile')->findOrFail($data->userId);

            $submission = DB::transaction(function () use ($data) {
                return $this->createSubmission($data);
            });

            $folderId = $this->storage->makePath(
                "submission/user_{$user->profile->firstname}-{$user->profile->lastname}_{$submission->id}"
            );

            $uploadedFiles = [];
            foreach ($data->files as $type => $file) {
                $uploadedFiles[$type] = $this->storage->uploadToFolder(
                    parentId: $folderId,
                    file: $file,
                    fileName: "{$type}_v1",
                );
            }

            DB::transaction(function () use ($submission, $data, $user, $folderId, $uploadedFiles) {
                $submission->update([
                    'drive_folder_id' => $folderId,
                ]);

                $this->createSubmissionFiles($data->files, $uploadedFiles, $submission->id);
                
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

    private function createSubmission(SubmissionData $data): Submission
    {
        $profile = Profile::where('user_id', $data->userId)->firstOrFail();
        return Submission::create([
            'submitted_by' => $data->userId,
            'presentation_type' => $profile->presentation_type,
            'title_th' => $data->titleTH,
            'title_en' => $data->titleEN,
            'keywords' => $data->keyword,
            'status' => SubmissionStatus::PENDING,
        ]);
    }

    private function createSubmissionFiles(array $files, array $uploadedFiles, string $submission_id): void
    {
        foreach ($files as $type => $file) {
            SubmissionFile::create([
                'submission_id' => $submission_id,
                'type' => $type,
                'drive_file_id' => $uploadedFiles[$type],
                'original_file_name' => $file->getClientOriginalName(),
            ]);
        }
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
