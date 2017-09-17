<?php

namespace App\Traits;
use App\Analythic;
use Illuminate\Support\Facades\Cookie;

trait AnalythicTrait{
    public function add_analythic()
    {
        if(Cookie::has('ev_hash')){
            Analythic::create([
                'hash' =>Cookie::get('ev_hash'),
                'browser_info' => request()->header('User-Agent'),
            ]);
        }
        else{
            $hash = hash('md5', date('Y/m/d/H:i:s'));
            Cookie::queue('ev_hash', $hash, 45);
            \Log::info('created_cookie');
            Analythic::create([
                'hash' => $hash,
                'browser_info' => request()->header('User-Agent'),
            ]);
        }


    }

}
