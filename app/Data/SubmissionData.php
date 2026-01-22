<?php

namespace App\Data;

use App\Enums\SubmissionFileType;
use App\Http\Requests\SubmissionRequest;
use Illuminate\Http\UploadedFile;

final class SubmissionData
{
    public function __construct(
        public string $userId,
        public array $groups,           // [priority => groupId]
        public string $titleTH,
        public string $titleEN,
        public string $keyword,
        public array $files,            // [type => UploadedFile]
        public array $participants,
    ) {}

    public static function fromRequest(SubmissionRequest $request): self
    {
        $files = [];
        if ($file = $request->file('abstract_th'))
            $files[SubmissionFileType::ABSTRACT_TH->value] = $file;
        
        if ($file = $request->file('abstract_en'))
            $files[SubmissionFileType::ABSTRACT_EN->value] = $file;
        
        if ($file = $request->file('poster'))
            $files[SubmissionFileType::POSTER->value] = $file;
        

        return new self(
            userId: $request->user()->id,
            groups: $request->validated('groups'),
            titleTH: $request->validated('title_th'),
            titleEN: $request->validated('title_en'),
            keyword: $request->validated('keyword'),
            files: self::extractFiles($request),
            participants: $request->validated('participants', []),
        );
    }

    private static function extractFiles(SubmissionRequest $request): array
    {
        return collect([
            SubmissionFileType::ABSTRACT_TH->value => 'abstract_th',
            SubmissionFileType::ABSTRACT_EN->value => 'abstract_en',
            SubmissionFileType::POSTER->value      => 'poster',
        ])
            ->mapWithKeys(fn ($input, $type) =>
                $request->file($input)
                    ? [$type => $request->file($input)]
                    : []
            )
            ->all();
    }
}
