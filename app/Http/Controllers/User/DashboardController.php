<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Mail;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $mails = Mail::all();
        $users = User::all();
        return view('pages.user.dashboard', [
            'mails' => $mails,
            'users' => $users,
        ]);
    }
}
