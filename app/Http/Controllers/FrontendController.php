<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
  public function index()
  {
    return view('sites.home');
  }
  public function about()
  {
    return view('sites.about');
  }
  public function events()
  {
    return view('sites.events');
  }
  public function sga()
  {
    return view('sites.sga');
  }
  public function info()
  {
    return view('sites.info');
  }
  public function contact()
  {
    return view('sites.contact');
  }
  public function imprint()
  {
    return view('sites.imprint');
  }
}
