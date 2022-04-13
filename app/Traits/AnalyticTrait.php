<?php

namespace App\Traits;

use App\Models\Analytic;
use Illuminate\Support\Facades\Cookie;

trait AnalyticTrait
{
    public function add_analytic()
    {
        if (Cookie::has('ev_hash')) {
            Analytic::create([
                'hash' => Cookie::get('ev_hash'),
                'browser_info' => request()->header('User-Agent'),
            ]);
        } else {
            $hash = hash('md5', date('Y/m/d/H:i:s'));
            Cookie::queue('ev_hash', $hash, 45);
            Analytic::create([
                'hash' => $hash,
                'browser_info' => request()->header('User-Agent'),
            ]);
        }
    }
}
