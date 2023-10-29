<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $response = Http::get('https://api.openweathermap.org/data/2.5/weather?lat=-45.031162&lon=168.662643&appid=dba7ca749857059c95601ef7c538c713');
    
        $jsonData = $response->json();
          
        //dd($jsonData);
        //echo $jsonData;
        if ($response -> successful()){
            //dd($response);
            return view('home')-> with('testgg', $jsonData);
        }
    }
}
