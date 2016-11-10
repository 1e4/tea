<?php

namespace App\Http\Controllers;

use App\Drinks;
use App\Round;
use Illuminate\Http\Request;

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
    
    public function getIndex()
    {
        $data = [];

        $data['round'] = Round::limit(1)->orderby('DESC')->first();

        return view('index', $data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['people'] = Drinks::all();

        return view('home', $data);
    }
}
