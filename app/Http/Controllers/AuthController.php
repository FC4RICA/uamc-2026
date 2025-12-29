<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister(): View
    {
        $organ = [
            ['id' => '1', 'title' => 'มหาวิทยาลัยศิลปากร'], 
            ['id' => '2', 'title' => 'สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง'],
            ['id' => '3', 'title' => 'มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี'],
            ['id' => '4', 'title' => 'มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าพระนครเหนือ'],
            ['id' => '4', 'title' => 'มหาวิทยาลัยเทคโนโลยีสุรนารี'],
        ];

        return view('public.register', ['status' => 1, 'errors' => [], 'organ' => $organ]);
    }
    

    public function showSignin(): View
    {
        return view('public.signin', ['incorrect' => 0]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('public.home');
    }
}