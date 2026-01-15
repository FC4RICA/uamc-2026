<?php

namespace App\Contracts;

use Illuminate\Http\UploadedFile;

interface CloudStorage
{
     public function upload(
        string $path,
        UploadedFile $file,
        ?string $mimeType = null,
    ): string;

    public function getFileInfo(string $fileId): array;

    public function makeDir(
        string $name,
        ?string $parentId = null
    ): string;

    public function all(string $folderId): array;
}
