<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SettingKey;
use App\Http\Controllers\Controller;
use App\Services\AppSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function __invoke(): View
    {
        $user = Auth::user();

        $actions = [
            SettingKey::RegistrationOpen->value => [
                'label' => 'การเปิดลงทะเบียน',
            ],
            SettingKey::AbstractSubmissionOpen->value => [
                'label' => 'การเปิดรับผลงาน',
            ],
        ];

        $toggles = collect($actions)->map(function ($config, $key) {
            $settingKey = SettingKey::from($key);
            
            return [
                'key'    => $settingKey,
                'status' => AppSetting::enabled($settingKey),
                'route'  => route('admin.setting.toggle', $key),
                'config' => $config,
            ];
        });

        return view('admin.dashboard', compact('user', 'toggles'));
    }
}
