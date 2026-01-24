<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
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
