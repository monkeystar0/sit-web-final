<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\ReservationItem;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\MailSenderController;
use DateTimeZone;

class Management extends Component
{
    public $reservations_pending = [];
    public $reservations_confirmed = [];
    public $reservations_cancelled = [];
    public $menuList = [];

    public function render()
    {
        return view('livewire.management');
    }

    public function mount()
    {

        $currentDateTime = Carbon::now(new \DateTimeZone('Pacific/Auckland'));

        // Format the date to match the database format (without zero-padding)
        $dateToday = $currentDateTime->format('Y-n-j'); // 'n' for month without leading zeros, 'j' for day without leading zeros
        $timeNow = $currentDateTime->format('H:i'); // Time is usually zero-padded

        $this->reservations_pending = ReservationItem::where('status', 1)
            ->orderBy('res_date', 'asc')
            ->orderBy('res_time', 'asc')
            ->get();

        $this->reservations_confirmed = ReservationItem::where(function ($query) use ($currentDateTime) {
            $query->where('res_date', '>', $currentDateTime->toDateString())
                ->orWhere(function ($query) use ($currentDateTime) {
                    $query->where('res_date', $currentDateTime->toDateString())
                        ->where('res_time', '>=', $currentDateTime->toTimeString());
                });
        })->where('status', 2)
            ->orderBy('res_date', 'asc')
            ->orderBy('res_time', 'asc')
            ->get();

        $this->reservations_cancelled = ReservationItem::where(function ($query) use ($currentDateTime) {
            $query->where('res_date', '>', $currentDateTime->toDateString());
        })->where('status', 3)
            ->orderBy('res_date', 'asc')
            ->orderBy('res_time', 'asc')
            ->get();
    }

    #[On('menuClick')]
    public function setMenuDetail($id)
    {
        $reserveItem = ReservationItem::where('id', $id)->take(1)->get();
        if (count($reserveItem) > 0){
            $this->menuList = $reserveItem[0]->menuItems;
        }
    }

    #[On('confirmReserve')]
    public function confirmReserveProcess($id)
    {
        $sender = new MailSenderController;
        $sender->sendMail($id);
        
        ReservationItem::where('id', $id)
            ->update(['status' => '2']);
        $this->mount();
    }

    #[On('cancelReserve')]
    public function cancelReserveProcess($id)
    {
        ReservationItem::where('id', $id)
            ->update(['status' => '3']);
        $this->mount();
    }

    
}
