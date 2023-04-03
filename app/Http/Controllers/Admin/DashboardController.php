<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mail;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $mails = Mail::all();
        $users = User::all();
        return view('pages.admin.dashboard', [
            'mails' => $mails,
            'users' => $users,
        ]);
    }
}
