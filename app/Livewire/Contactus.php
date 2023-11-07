<?php

namespace App\Livewire;

use Livewire\Component;

class Contactus extends Component
{
    public $res_status = false;
    public $res_status_text = 'error';
    public $res_status_css = '';

    public function render()
    {
        return view('livewire.contactus');
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

    public function contactus(){
        redirect()->to('/contact');
    }

    public function goToFoodMenu(){
        redirect()->to('/reserve#menu-selecting');
    }

}
    