<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|min:8|max:50',
            'password' => 'required|min:8|max:50'
        ]);

        $admin = Admin::where('username', $request->username)
            ->where('password', base64_encode($request->password))
            ->get(['idAdmin', 'image', 'username']);

        if($admin->count()){
            session(['admin' => $admin->toArray()[0]['idAdmin']]);
            $image = $admin->toArray()[0]['image'];
            $username = $admin->toArray()[0]['username'];

            session([
                'username' => $username,
                'image' => $image
            ]);

            return redirect(route('admin_root_path'));
        } else {
            $errors = ['Invalid Username or Password'];
            return view('login')->withErrors($errors);
        }
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect(route('login'));
    }
}
