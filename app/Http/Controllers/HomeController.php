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
        $this->middleware('auth', [
            'except'    =>  [
                'getIndex'
            ]
        ]);
    }

    /**
     * Send a notification to setup the new round
     * 
     * @return void
     */
    public function callRound()
    {
        // Email or setup a new round, again, we don't have the email, but this would just send a notification to start
        // a new round
    }

    /**
     * Show the index page containing information about the current tea round as well as who was chosen
     *
     * @return mixed
     */
    public function getIndex()
    {
        $data = [];

        $data['round'] = Round::limit(1)->orderby('id', 'DESC')->first();

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
        $data['round'] = Round::limit(1)->orderby('id', 'DESC')->first();

        return view('home', $data);
    }
}
