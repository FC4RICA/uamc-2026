<?php

namespace App\Services;

use Google\Client;
use Google\Service\Drive;

class GoogleDriveClient
{
    protected Drive $drive;
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setClientId(config('services.google.client_id'));
        $this->client->setClientSecret(config('services.google.client_secret'));
        $this->client->refreshToken(config('services.google.refresh_token'));

        $this->client->setScopes([Drive::DRIVE]);

        $this->drive = new Drive($this->client);
    }

    public function drive(): Drive
    {
        return $this->drive;
    }

    public function client(): Client
    {
        return $this->client;
    }
}
