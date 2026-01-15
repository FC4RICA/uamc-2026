<?php

namespace App\Services;

use App\Contracts\CloudStorage;
use Google\Service\Drive\DriveFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class GoogleDriveStorage implements CloudStorage
{
    public function __construct(
        protected GoogleDriveClient $client
    ) {}

    public function upload(
        string $path,
        UploadedFile $file,
        ?string $mimeType = null,
    ): string {
        [$folderId, $name] = $this->parsePath($path);
        Log::debug('GoogleDriveStorage.upload parsePath', compact('path', 'folderId', 'name'));

        $driveFile = new DriveFile([
            'name' => $name,
            'parents' => [$folderId],
        ]);

        $created = $this->client->drive()->files->create(
            $driveFile,
            [
                'data' => file_get_contents($file->getRealPath()),
                'mimeType' => $mimeType ?? $file->getMimeType(),
                'uploadType' => 'multipart',
                'fields' => 'id, name, webViewLink, webContentLink'
            ]
        );

        return $created->id;
    }

    public function delete(string $fileId): void
    {
        $this->client->drive()->files->delete($fileId);
    }

    public function getFileInfo(string $fileId): array
    {
        $file = $this->client->drive()->files->get(
            $fileId,
            [
                'fields' => implode(',', [
                    'id',
                    'name',
                    'mimeType',
                    'size',
                    'createdTime',
                    'modifiedTime',
                    'parents',
                    'md5Checksum',
                    'owners',
                    'webViewLink',
                    'webContentLink',
                ]),
            ]
        );

        return [
            'id' => $file->id,
            'name' => $file->name,
            'mime_type' => $file->mimeType,
            'size' => $file->size,
            'created_at' => $file->createdTime,
            'modified_at' => $file->modifiedTime,
            'parents' => $file->parents,
            'md5' => $file->md5Checksum,
            'owners' => collect($file->owners)->pluck('emailAddress'),
            'view_url' => $file->webViewLink,
            'download_url' => $file->webContentLink,
        ];
    }

    public function makeDir(string $name, ?string $parentId = null): string {
        $file = new DriveFile([
            'name' => $name,
            'mimeType' => 'application/vnd.google-apps.folder',
            'parents' => $parentId ? [$parentId] : [],
        ]);

        return $this->client->drive()->files->create($file)->id;
    }

    public function all(string $folderId): array
    {
        $files = $this->client->drive()->files->listFiles([
            'q' => "'{$folderId}' in parents and trashed = false",
            'fields' => 'files(id, name, mimeType)',
        ]);

        return $files->getFiles();
    }

    protected function parsePath(string $path): array
    {
        $segments = explode('/', $path);
        $name = array_pop($segments);
        Log::debug('GoogleDriveStorage.parsePath explode pop', compact('segments', 'name'));

        $parentId = config('services.google.folder_id');

        foreach ($segments as $folderName) {
            Log::debug('GoogleDriveStorage.parsePath $segments as $folderName', compact('folderName', 'name'));
            $parentId = $this->getOrCreateFolder($folderName, $parentId);
        }

        return [$parentId, $name];
    }

    protected function getOrCreateFolder(string $name, string $parentId): string
    {
        $drive = $this->client->drive();

        $result = $drive->files->listFiles([
            'q' => sprintf(
                "mimeType='application/vnd.google-apps.folder'
                and name='%s'
                and '%s' in parents
                and trashed=false",
                addslashes($name),
                $parentId
            ),
            'fields' => 'files(id)',
        ]);

        if (count($result->files)) {
            return $result->files[0]->id;
        }

        return $this->makeDir($name, $parentId);
    }
}
