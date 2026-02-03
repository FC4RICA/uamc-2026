<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        return view('admin.dashboard', compact('user'));
    }
}
