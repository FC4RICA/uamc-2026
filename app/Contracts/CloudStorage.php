<?php

namespace App\Contracts;

use Illuminate\Http\UploadedFile;
use Psr\Http\Message\StreamInterface;

interface CloudStorage
{
     public function upload(
        string $path,
        UploadedFile $file,
        ?string $mimeType = null,
    ): string;

    public function uploadToFolder(
        string $parentId,
        UploadedFile $file,
        string $fileName,
        ?string $mimeType = null,
    ): string;

    public function getFileInfo(string $fileId): array;

    public function download(string $fileId): StreamInterface;

    public function makePath(string $path): string;

    public function all(string $folderId): array;
}
