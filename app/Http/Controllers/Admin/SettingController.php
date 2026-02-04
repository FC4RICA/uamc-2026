<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SettingKey;
use App\Http\Controllers\Controller;
use App\Services\AppSetting;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function __invoke(SettingKey $key)
    {
        $current = AppSetting::enabled($key);
        AppSetting::set($key, ! $current);

        return back();
    }
}
