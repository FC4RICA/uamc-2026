<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request): View
    {
        $profiles = Profile::realParticipants()
            ->with([
                'organization', 
                'user.payments', 
                'submissions'
            ])
            ->filter($request->only([
                'participationType', 
                'presentationType', 
                'payment', 
                'search'
            ]))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.profile.index', compact('profiles'));
    }

    public function show(Profile $profile)
    {
        return;
    }
}