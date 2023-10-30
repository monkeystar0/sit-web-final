<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On; 
use Illuminate\Support\Facades\Log; 

class Reservation extends Component
{
    public $no_persons = [1,2,3,4,5,6,7,8,9,10];
    public $available_time_slots = ['09:00','10:00','11:00', '12:00', '13:00'];
    public $available_time_slots2 = ['11:00','12:00','14:00', '15:00', '16:00'];
    public $selectedDate = '';
    public $selectedTime = '';
    public $reserveName = '';
    public $customerTel = "";
    public $availableSeat = '';


    public function render()
    {
        //Log::info('updatedSearchTerm was triggered');
        return view('livewire.reservation');
    }

    // public function updatedSelectedDate()
    // {
    //     $this->available_time_slots = $this->available_time_slots2;
    // }


    public function updatedReserveName()
    {
         $this->dispatch('searchTermUpdated', $this->selectedDate);

    }

    public function updatedSelectedTime()
    {
        $this->availableSeat = 'Avaialable seats: 5';
         $this->dispatch('searchTermUpdated', 'selected timeee');

    }

    public function setSelectedDate($date)
    {
        $this->selectedDate = $date;
        $this->dispatch('searchTermUpdated', $this->selectedDate);
        //check available time slot
        $this->available_time_slots = $this->available_time_slots2;
    }


    // public function rendered($view, $html)
    // {
    //     // Runs AFTER the provided view is rendered...
    //     $this->dispatch('searchTermUpdated', "meme");
    //     $this ->customerTel = "000000";
    //     // $view: The rendered view
    //     // $html: The final, rendered HTML
    // }

    #[On('setInitialSelectedDate')] 
    public function updateInitialDate($message)
    {
        Log::info('setInitialSelectedDate was triggered'.$message);
    }

    // public function updating($property, $value)
    // {
    //     dd($value);
    //     echo 'test';
    // }

    // public function updated($property)
    // {
    //     // $property: The name of the current property that was updated
    //     //dd($property);
    //     echo 'test';
    //     if ($property === 'todo') {
    //         $this->todo = strtolower($this->username);
    //     }
    // }
    // public function save()
    // {
    //     echo 'test';
    // }

    // public function mount()
    // {
    //     $this ->reserveName = "test";
    //     $this ->todo = "test";
    // }
}
