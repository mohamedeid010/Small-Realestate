<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Realestate;
use App\Detail;
use App\Season;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $realestates=Realestate::paginate(15);
      return view('realestates.showall')->with('realestates',$realestates);
    }
}
