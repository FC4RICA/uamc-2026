<?php

namespace App\Actions\Submission;

use App\Contracts\CloudStorage;
use App\Data\Submission\UpdateAbstractSubmissionData;
use App\Enums\ParticipationType;
use App\Enums\SubmissionFileType;
use App\Models\Profile;
use App\Models\Submission;
use App\Models\SubmissionFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UpdateAbstractSubmission
{
    public function __construct(
        protected CloudStorage $storage
    ) {}

    public function handle(
        Submission $submission,
        UpdateAbstractSubmissionData $data
    ): void {
        DB::transaction(function () use ($submission, $data) {

            $this->updateSubmissionFields($submission, $data);

            if ($data->abstract !== null) {
                $this->uploadNewAbstractVersion($submission, $data);
            }

            $this->syncGroups($submission, $data->groups);

            $this->syncProfiles($submission, $data->participants);
        });
    }

    private function updateSubmissionFields(
        Submission $submission,
        UpdateAbstractSubmissionData $data
    ): void {
        $submission->update([
            'title_th' => $data->titleTH,
            'title_en' => $data->titleEN,
            'keywords' => $data->keywords,
        ]);
    }

    private function uploadNewAbstractVersion(
        Submission $submission,
        UpdateAbstractSubmissionData $data
    ): void {
        $round = $submission->abstractRound();
        $latestVersion = (int) $round->files()->max('version');
        $version = $latestVersion + 1;
        $info = pathinfo($data->abstract->getClientOriginalName());

        $fileId = $this->storage->uploadToFolder(
            parentId: $submission->drive_folder_id,
            file: $data->abstract,
            fileName: "{$info['filename']}_v{$version}.{$info['extension']}",
        );

        SubmissionFile::create([
            'submission_round_id' => $round->id,
            'file_type' => SubmissionFileType::ABSTRACT,
            'drive_file_id' => $fileId,
            'original_file_name' => $data->abstract->getClientOriginalName(),
            'version' => $version,
        ]);
    }

    private function syncProfiles(Submission $submission, array $participants): void
    {
        $ids = [];

        foreach ($participants as $data) {
            if (isset($data['id'])) {
                $profile = Profile::whereKey($data['id'])->firstOrFail();

                if (! $submission->profiles->contains($profile->id)) {
                    throw ValidationException::withMessages([
                        'participants' => 'Invalid profile reference.',
                    ]);
                }

                $profile->update(
                    Arr::only($data, [
                        'firstname',
                        'lastname',
                        'phone',
                        'special_requirements',
                        'title',
                        'academic_title',
                        'education',
                        'organization_id',
                        'organization_other',
                        'occupation_id',
                        'occupation_other',
                    ])
                );
            } else {
                // CREATE (force system fields)
                $profile = Profile::create([
                    ...$data,
                    'participation_type' => ParticipationType::PRESENTER,
                    'presentation_type'  => $submission->presentation_type,
                    'created_by'         => $submission->submitted_by,
                ]);
            }

            $ids[] = $profile->id;
        }

        // Always include owner profile
        $ids[] = $submission->user->profile->id;
        $submission->profiles()->sync($ids);
    }

    private function syncGroups(Submission $submission, array $groups): void
    {
        $pivotData = [];
        foreach ($groups as $priority => $groupId) {
            if(!empty($groupId))
                $pivotData[$groupId] = ['priority' => $priority];
        }
        $submission->abstractGroups()->sync($pivotData);
    }
}
