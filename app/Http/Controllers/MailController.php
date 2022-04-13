<?php

namespace App\Http\Controllers;

use App\Mail\EvMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    // https://dev.to/aoamusat/sending-email-in-laravel-app-using-gmail-account-iaj
    public function send_ev(Request $request)
    {
        Mail::to(env('APP_EV_ADDRESS', ''))->queue(new EvMail($request->mail, ['name' => $request->name, 'text' => $request->text]));
        session()->flash('ev_mail', 'E-Mail wurde gesendet...');

        return redirect()->back();
    }

    public function send_obmann(Request $request)
    {
        Mail::to(env('APP_OBMANN_ADDRESS', ''))->queue(new EvMail($request->mail, ['name' => $request->name, 'text' => $request->text]));
        session()->flash('obmann_mail', 'E-Mail wurde gesendet...');

        return redirect()->back();
    }
}
