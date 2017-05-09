<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Text;
use App\Menu;
class FrontendController extends Controller
{
  public function dynamic($route){
    $menu=Menu::where('route', $route)->first();
    return view('sites.'. $menu->template,['content' => $menu->content]);
  }
  public function index()
  {
    return view('sites.home');
  }
  public function about()
  {
    $blocks = Text::where('category', '0')->get();
    return view('sites.about',['blocks' => $blocks]);
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
