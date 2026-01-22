<?php

namespace App\Services;

use App\Contracts\CloudStorage;
use Google\Service\Drive\DriveFile;
use Illuminate\Http\UploadedFile;
use Psr\Http\Message\StreamInterface;

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

        return $this->uploadToFolder(
            parentId: $folderId,
            file: $file,
            fileName: $name,
            mimeType: $mimeType,
        );
    }

    public function uploadToFolder(
        string $parentId,
        UploadedFile $file,
        string $fileName,
        ?string $mimeType = null,
    ): string {
        $driveFile = new DriveFile([
            'name' => $fileName,
            'parents' => [$parentId],
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

    public function download(string $fileId): StreamInterface
    {
        $response = $this->client->client()->getHttpClient()->request(
             'GET',
            sprintf(
                'https://www.googleapis.com/drive/v3/files/%s?alt=media',
                $fileId
            ),
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->client->client()->getAccessToken()['access_token'],
                ],
                'stream' => true,
            ]
        );

        return $response->getBody();
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

    public function makePath(string $path): string
    {
        $segments = array_filter(explode('/', trim($path, '/')));

        $parentId = config('services.google.folder_id');

        foreach ($segments as $segment) {
            $parentId = $this->getOrCreateFolder($segment, $parentId);
        }

        return $parentId;
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

        $parentId = config('services.google.folder_id');

        foreach ($segments as $folderName) {
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

        return $this->createFolder($name, $parentId);
    }

    protected function createFolder(string $name, ?string $parentId = null): string {
        $file = new DriveFile([
            'name' => $name,
            'mimeType' => 'application/vnd.google-apps.folder',
            'parents' => $parentId ? [$parentId] : [],
        ]);

        return $this->client->drive()->files->create($file)->id;
    }
}
