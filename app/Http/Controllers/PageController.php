<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('pages.home');
    }

    public function observation()
    {
        return view('pages.observation');
    }

    public function forecast()
    {
        return view('pages.forecast');
    }    

    public function longterm()
    {
        return view('pages.longterm');
    }    
}
