<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ReservationItem;
use App\Models\ReservationMenuItem;

class ReservationConfirm extends Component
{
    public $reservation_id = '';
    public $reservationInfo = App\Models\ReservationItem::class;
    public $menuList = array();
    public $totalToPay = 0.0;
    public $statusDisplay = ["","PENDING","CONFIRMED","CANCELED"];

    public function render()
    {
        return view('livewire.reservation-confirm');
    }

    public function mount($reservation_id){
        $this->reservation_id = $reservation_id;
        $this->reservationInfo = ReservationItem::where('id', $reservation_id)->take(1)->get();
        if (count($this->reservationInfo) == 0){
            $this->redirect('/');
        }
        $this->menuList = ReservationMenuItem::where('reservation_id', $reservation_id)->get();
        $this->totalToPay = collect($this->menuList)->sum('price');

    }

    public function backHome(){
        $this->redirect('/');
    }
}
