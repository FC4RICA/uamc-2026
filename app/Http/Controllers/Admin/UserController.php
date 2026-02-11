<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::with('profile')
            ->filter($request->only(['participationType', 'submission', 'payment', 'role']))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.user.index', compact('users'));
    }
}
