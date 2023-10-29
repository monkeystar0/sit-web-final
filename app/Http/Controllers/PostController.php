<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function get_weather_data(){
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
    
        $jsonData = $response->json();
          
        dd($jsonData);
    }
}
