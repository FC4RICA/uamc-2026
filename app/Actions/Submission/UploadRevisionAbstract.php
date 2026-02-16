<?php

namespace App\Actions\Submission;

use App\Contracts\CloudStorage;
use App\Enums\SubmissionFileType;
use App\Enums\SubmissionStatus;
use App\Models\SubmissionFile;
use App\Models\SubmissionRevision;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class UploadRevisionAbstract
{
     public function __construct(
        protected CloudStorage $storage
    ) {}

    public function handle(
        SubmissionRevision $revision,
        UploadedFile $file,
    ): void {
        $submission = $revision->submission;
        DB::transaction(function () use ($revision, $file, $submission) {
            $round = $submission->abstractRound();
            $latestVersion = (int) $round->files()->max('version');
            $version = $latestVersion + 1;
            $info = pathinfo($file->getClientOriginalName());
            $fileId = $this->storage->uploadToFolder(
                parentId: $submission->drive_folder_id,
                file: $file,
                fileName: "{$info['filename']}_v{$version}_revision.{$info['extension']}",
            );

            $submission->update([
                'status' => SubmissionStatus::PENDING,
            ]);

            $submissionFile = SubmissionFile::create([
                'submission_round_id' => $round->id,
                'file_type' => SubmissionFileType::ABSTRACT,
                'drive_file_id' => $fileId,
                'original_file_name' => $file->getClientOriginalName(),
                'version' => $version,
            ]);

            $revision->update([
                'resolved_at' => now(),
                'submission_file_id' => $submissionFile->id,
            ]);
        });
    }
}