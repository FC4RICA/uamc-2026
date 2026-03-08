<?php

namespace App\Actions\Submission;

use App\Contracts\CloudStorage;
use App\Enums\SubmissionFileType;
use App\Enums\SubmissionRoundType;
use App\Models\Submission;
use App\Models\SubmissionFile;
use App\Models\SubmissionRound;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

/*
Handle the creation of the final round of submission,
including extended abstract, poster and recommendation letter
*/
class UpdateFinalSubmission
{
    public function __construct(
        protected CloudStorage $storage
    ) {}

    public function handle(
        Submission $submission,
        ?UploadedFile $recommendation,
        ?UploadedFile $extendedAbstract,
        ?UploadedFile $poster,
    ): void {
        DB::transaction(function () use ($submission, $recommendation, $extendedAbstract, $poster) {
            $files = [
                SubmissionFileType::RECOMMENDATION_LETTER->value => $recommendation,
                SubmissionFileType::EXTENDED_ABSTRACT->value => $extendedAbstract,
                SubmissionFileType::POSTER->value => $poster,
            ];

            $finalRound = $submission->finalRound();

            foreach ($files as $type => $file) {
                if (!$file) continue;

                $this->storeFile(
                    submission: $submission,
                    round: $finalRound,
                    file: $file,
                    type: SubmissionFileType::from($type)
                );
            }
        });
    }

    private function storeFile(
        Submission $submission,
        SubmissionRound $round,
        UploadedFile $file,
        SubmissionFileType $type
    ): void {
        $latestVersion = (int) $round->files()
            ->where('file_type', $type)
            ->max('version');
        $version = $latestVersion + 1;
        $info = pathinfo($file->getClientOriginalName());

        $fileId = $this->storage->uploadToFolder(
            parentId: $submission->drive_folder_id,
            file: $file,
            fileName: "{$info['filename']}_v{$version}.{$info['extension']}",
        );
        
        SubmissionFile::create([
            'submission_round_id' => $round->id,
            'file_type' => $type,
            'drive_file_id' => $fileId,
            'original_file_name' => $file->getClientOriginalName(),
            'version' => $version,
        ]);
    }
}
