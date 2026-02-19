<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CloudStorage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DriveController extends Controller
{
    public function show(string $id, CloudStorage $storage): StreamedResponse
    {
        $stream = $storage->download($id);
        $info = $storage->getFileInfo($id);

        return response()->stream(
            function () use ($stream) {
                echo $stream->getContents();
            },
            200,
            [
                'Content-Type' => $info['mime_type'],
                'Cache-Control' => 'public, max-age=86400',
            ]
        );
    }
}
