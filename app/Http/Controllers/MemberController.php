<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        return view('member.welcome', compact('user'));
    }
}
