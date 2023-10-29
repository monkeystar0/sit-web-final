<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On; 
use Illuminate\Support\Facades\Log; 

class Reservation extends Component
{
    public $no_persons = [1,2,3,4,5,6,7,8,9,10];
    public $available_time_slots = ['09:00','10:00','11:00', '12:00', '13:00'];
    public $available_time_slots2 = ['09:00','10:00','11:00', '12:00', '13:00'];
    public $selectedDate = '';
    public $selectedTime = '';
    public $reserveName = 'test';
    public $todo = 'test';
    public $customerTel = "00";


    public function render()
    {
        Log::info('updatedSearchTerm was triggered');
        return view('livewire.reservation');
    }

    public function updatedSelectedDate()
    {
        echo 'test</br>';
    }

    public function mount()
{
    Log::info("Component has been mounted.");
}

    public function updatedReserveName()
    {
        echo 'test</br>';
        $this->emit('searchTermUpdated', "wohoo");
        Log::info('updatedSearchTerm was triggered');
        $this ->customerTel = "123456";
    }

    #[On('check-time-slots')] 
    public function updateTimeSlot($selectedDate)
    {
        
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
