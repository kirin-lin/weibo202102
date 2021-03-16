<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Hash;
use Illuminate\Support\Str;
use DB;
use Mail;
use Carbon\Carbon;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('throttle:3, 10', [
            'only' => ['showLineRequestForm']
        ]);
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $email = $request->email;

        $user = User::where('email', $email)->first();

        if (is_null($user)) {
            session()->flash('danger', 'email 非註冊信箱');
            return redirect()->back()->withInput();
        }

        $token = hash_hmac('sha256', Str::random(40), config('app.key'));

        DB::table('password_resets')->updateOrInsert(['email' => $email],
            [
                'email' => $email,
                'token' => Hash::make($token),
                'created_at' => new Carbon,
            ]
        );

        Mail::send('emails.reset_link', compact('token'),
            function($message) use ($email) {
                $message->to($email)->subject("忘記密碼");
            });

        session()->flash('success', 'Reset Email send success');
        return redirect()->back();
    }

    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');
        return view('auth.passwords.reset', compact('token'));
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'require',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $email = $request->email;
        $token = $request->token;
        $expires = 60 * 10;

        $user = User::where('email', $email)->first();

        if (is_null($user)) {
            session()->flash('danger', '非註冊信箱');
            return redirect()->back()->withInput();
        }

        $record = (array) DB::table('password_resets')->where('email', $email)->first();

        if ($record) {
            if (Carbon::parse($record['created_at'])->addSeconds($expires)->isPast()) {
                session()->flash('danger', 'Link expired, please retry');
                return redirect()->back();
            }

            if ( ! Hash::check($token, $record['token'])) {
                session()->flash('danger', 'token error');
                return redirect()->back();
            }

            $user->update(['password' => bcrypt($request->password)]);

            session()->flash('success', 'password reset success');
            return redirect()->route('login');
        }

        session()->flash('danger', 'No reset record');
        return redirect()->back();


    }
}
