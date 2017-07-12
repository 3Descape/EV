<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\EvMail;
use Session;

class MailController extends Controller
{
    public function send_ev(Request $request)
    {
        Mail::to(config('app.ev_address'))->queue(new EvMail($request->mail, ['name' => $request->name, 'text' => $request->text]));
        session()->flash('ev_mail', 'E-Mail wurde gesendet...');
        return redirect()->back();

    }
    public function send_obmann(Request $request)
    {
        Mail::to(config('app.obmann_address'))->queue(new EvMail($request->mail, ['name' => $request->name, 'text' => $request->text]));
        session()->flash('obmann_mail', 'E-Mail wurde gesendet...');
        return redirect()->back();
    }
}
