<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SettingKey;
use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Models\User;
use App\Services\AppSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function __invoke(): View
    {
        $user = Auth::user();
        $toggles = $this->toggles();
        $metrics =$this->metrics();

        return view('admin.dashboard', compact('user', 'toggles', 'metrics'));
    }

    private function metrics(): array
    {
        return [
            'users_total' => User::participants()->count(),
            'presenters' => User::participants()->presenters()->count(),
            'attendees'  => User::participants()->attendees()->count(),
            'submissions' => Submission::active()->count(),

            'pending_submission' => Submission::active()->pending()->count(),
            'revised_submission' => Submission::active()->reviseRequired()->count(),
            'accepted_submission' => Submission::active()->accepted()->count(),
            'rejected_submission' => Submission::active()->rejected()->count(),

            'pending_payment' => User::participants()->unpaid()->count(),
            'submitted_payment' => User::participants()->paymentSubmitted()->count(),
            'verified_payment' => User::participants()->paymentVerified()->count(),
            'required_payment' => User::participants()->paymentRequired()->count(),
        ];
    }

    private function toggles(): Collection
    {
        $actions = [
            SettingKey::RegistrationOpen->value => [
                'label' => 'การเปิดลงทะเบียน',
            ],
            SettingKey::AbstractSubmissionOpen->value => [
                'label' => 'การเปิดรับผลงาน',
            ],
        ];

        return collect($actions)->map(function ($config, $key) {
            $settingKey = SettingKey::from($key);
            
            return [
                'key'    => $settingKey,
                'status' => AppSetting::enabled($settingKey),
                'route'  => route('admin.setting.toggle', $key),
                'config' => $config,
            ];
        });
    }
}
