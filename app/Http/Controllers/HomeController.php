<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShortLink;

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
        $data = Array();
        $data['shortLinks'] = ShortLink::latest()->get();

        return view('home')->with($data);
    }
}
