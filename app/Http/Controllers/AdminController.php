<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
  public function index()
  {
    return view('admin.sites.home');
  }
  public function about()
  {
    return view('admin.sites.about');
  }
  public function events()
  {
    return view('admin.sites.events');
  }
  public function sga()
  {
    return view('admin.sites.sga');
  }
  public function info()
  {
    return view('admin.sites.info');
  }
}
