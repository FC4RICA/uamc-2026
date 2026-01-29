<?php

namespace App\Data\Submission;

use App\Http\Requests\UpdateAbstractSubmissionRequest;
use Illuminate\Http\UploadedFile;

final class UpdateAbstractSubmissionData extends BaseAbstractSubmissionData
{
    public function __construct(
        public string $userId,
        public array $groups,
        public string $titleTH,
        public string $titleEN,
        public string $keywords,
        public ?UploadedFile $abstract,
        public ?array $participants,
    ) {}

    public static function fromRequest(
        UpdateAbstractSubmissionRequest $request
    ): self {
        return new self(
            userId: $request->user()->id,
            groups: $request->validated('groups'),
            titleTH: $request->validated('title_th'),
            titleEN: $request->validated('title_en'),
            keywords: $request->validated('keywords'),
            abstract: $request->validated('abstract'),
            participants: $request->has('participants')
                ? self::normalizeParticipants($request->validated('participants'))
                : null,
        );
    }
}
