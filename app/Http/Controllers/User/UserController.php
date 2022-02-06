<?php

namespace App\Http\Controllers\User;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('user.user_dash');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
