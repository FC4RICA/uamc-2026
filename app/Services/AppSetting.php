<?php

namespace App\Services;

use App\Enums\SettingKey;
use App\Models\Setting;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;

class AppSetting
{
     public static function get(SettingKey $key, $default = null)
    {
        // 1. If app is running in console during build / package discovery
        //    AND database is not ready → return default immediately
        if (App::runningInConsole() && ! static::databaseReady()) {
            return $default;
        }

        return cache()->remember(
            "setting:{$key->value}",
            60,
            fn () => Setting::where('key', $key->value)->value('value') ?? $default
        );
    }

    public static function enabled(SettingKey $key): bool
    {
        return (bool) static::get($key, false);
    }

    public static function set(SettingKey $key, $value): void
    {
        if (! static::databaseReady()) {
            return;
        }

        Setting::updateOrCreate(
            ['key' => $key->value],
            ['value' => $value]
        );

        cache()->forget("setting:{$key->value}");
    }

    private static function databaseReady(): bool
    {
        try {
            return Schema::hasTable('settings');
        } catch (\Throwable $e) {
            return false;
        }
    }
}
