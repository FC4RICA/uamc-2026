<?php

namespace App\Data\Submission;

use App\Http\Requests\CreateAbstractSubmissionRequest;
use Illuminate\Http\UploadedFile;

final class CreateAbstractSubmissionData extends BaseAbstractSubmissionData
{
    public function __construct(
        public string $userId,
        public array $groups,           // [priority => groupId]
        public string $titleTH,
        public string $titleEN,
        public string $keywords,
        public UploadedFile $abstract,            // [type => UploadedFile]
        public array $participants,
    ) {}

    public static function fromRequest(
        CreateAbstractSubmissionRequest $request
    ): self {
        return new self(
            userId: $request->user()->id,
            groups: $request->validated('groups'),
            titleTH: $request->validated('title_th'),
            titleEN: $request->validated('title_en'),
            keywords: $request->validated('keywords'),
            abstract: $request->validated('abstract'),
            participants: self::normalizeParticipants(
                $request->validated('participants', [])
            ),
        );
    }
}
