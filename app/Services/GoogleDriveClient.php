<?php

namespace App\Services;

use Google\Client;
use Google\Service\Drive;
use Illuminate\Support\Facades\Log;

class GoogleDriveClient
{
    protected Drive $drive;

    public function __construct()
    {
        $client = new Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->refreshToken(config('services.google.refresh_token'));

        $client->setScopes([Drive::DRIVE]);

        $this->drive = new Drive($client);
    }

    public function drive(): Drive
    {
        return $this->drive;
    }
}
