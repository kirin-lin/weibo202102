<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class SessionsController extends Controller
{
    public function __contruct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);

        $this->middleware('throttle:10, 10', [
            'only' => ['store']
        ]);
    }
    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);


        if(Auth::attempt($credentials, $request->has('remember'))) {
            if(Auth::user()->activated) {
                session()->flash('success', '歡迎回來!');
                // return redirect()->route('users.show', [Auth::user()]);
                $fallback = route('users.show', Auth::user());
                return redirect()->intended($fallback);
            } else {
                Auth::logout();
                session()->flash('warning', '你的帳號未啟用，請檢查信箱中的注冊郵件進行啟用');
            }
        } else {
            session()->flash('danger', "很抱歉，密碼錯誤");
            return redirect()->back()->withInput();
        }
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success', "Logout Successful");
        return redirect('login');
    }
}
