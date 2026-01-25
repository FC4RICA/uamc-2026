<?php

namespace App\Data;

use App\Http\Requests\AbstractSubmissionRequest;
use Illuminate\Http\UploadedFile;

final class AbstractSubmissionData
{
    public function __construct(
        public string $userId,
        public array $groups,           // [priority => groupId]
        public string $titleTH,
        public string $titleEN,
        public string $keyword,
        public UploadedFile $abstract,            // [type => UploadedFile]
        public array $participants,
    ) {}

    public static function fromRequest(AbstractSubmissionRequest $request): self
    {
        return new self(
            userId: $request->user()->id,
            groups: $request->validated('groups'),
            titleTH: $request->validated('title_th'),
            titleEN: $request->validated('title_en'),
            keyword: $request->validated('keyword'),
            abstract: $request->validated('abstract'),
            participants: $request->validated('participants', []),
        );
    }
}
