<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pages.user.setting-account', [
            'user' => $user,
        ]);
    }
    
    public function update(Request $request, $redirect)
    {
        $data = $request->all();

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        $item = Auth::user();
        $item->update($data);
        return redirect()->route($redirect);
    
    }
}
