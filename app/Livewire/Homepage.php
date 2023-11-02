<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Homepage extends Component
{
    public $res_status = false;
    public $res_status_text = 'error';
    public $res_status_css = '';

    public function render()
    {
        return view('livewire.homepage');
    }

    public function mount(){
        $this->res_status = config('front_res.status');
        
        if ($this->res_status) {
            $this->res_status_text = "Open";
            $this->res_status_css = "res-status-open";
        }else{
            $this->res_status_text = "Close";
            $this->res_status_css = "res-status-close";
        }
    }
    

    public function reserve(){
        redirect()->to('/reserve');
    }

    public function goToFoodMenu(){
        redirect()->to('/reserve#menu-selecting');
    }

    // public function index()
    // {
    //     $response = Http::get('https://api.openweathermap.org/data/2.5/weather?lat=-45.031162&lon=168.662643&appid=dba7ca749857059c95601ef7c538c713');
    
    //     $jsonData = $response->json();
          
    //     //dd($jsonData);
    //     //echo $jsonData;
    //     if ($response -> successful()){
    //         //dd($response);
    //         return view('livewire.homepage')-> with('testgg', $jsonData);
    //     }
    // }
}
