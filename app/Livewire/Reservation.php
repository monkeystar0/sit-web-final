<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On; 
use Illuminate\Support\Facades\Log; 
use Livewire\Attributes\Rule; 
use App\Models\MenuItem;

class Reservation extends Component
{
    public $no_persons = [1,2,3,4,5,6,7,8,9,10];
    public $available_time_slots = ['09:00','10:00','11:00', '12:00', '13:00'];
    public $available_time_slots2 = ['11:00','12:00','14:00', '15:00', '16:00'];
    #[Rule('required')] 
    public $selectedDate = '';
    #[Rule('required')]
    public $selectedTime = '-';
    #[Rule('required')] 
    public $reserveName = '-';
    #[Rule('required')] 
    public $customerTel = "";
    #[Rule('required')] 
    public $customerEmail = "";
    public $availableSeat = '';
    public $testModel = [];


    public function render()
    {
        //Log::info('updatedSearchTerm was triggered');
        return view('livewire.reservation');
    }

    public function mount(){
        //$this->testModel = array(new Menu('1', 'https://ucarecdn.com/377cfc3d-ad21-4b57-8449-40aeaf96af67/-/resize/x400/-/format/auto/-/progressive/yes/1-2.jpg', 5.99, "Spring vegtable rolls", "Spring vegtable rolls (serve with 6 rolls)"));
    }
    // public function updatedSelectedDate()
    // {
    //     $this->available_time_slots = $this->available_time_slots2;
    // }

    public function submitReservation(){
        Log::info('updatedSearchTerm was triggered'.json_encode($this->validate()));
        $this->validate();
        config(['front_res.status' => false]);
    }

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

    #[On('setInitialSelectedDate')] 
    public function updateInitialDate($message)
    {
        $this->selectedDate = $message;
    }

    public function goBack(){
        $menuItems = MenuItem::create([
            'name' => 'Spring vegtables rolls',
            'description' => 'serve with 6 rolls',
            'image' => 'https://ucarecdn.com/377cfc3d-ad21-4b57-8449-40aeaf96af67/-/resize/x400/-/format/auto/-/progressive/yes/1-2.jpg',
            'price' => 3.99
        ]);
        $menuItems = MenuItem::create([
            'name' => 'Golden Prawns (5pcs)',
            'description' => 'Thai style tempura prawns served with sweet chilli sauce',
            'image' => 'https://ucarecdn.com/dcc824e8-aafd-49fe-9754-406ced9661e5/-/resize/x400/-/format/auto/-/progressive/yes/9.jpg',
            'price' => 8.99
        ]);
        $menuItems = MenuItem::create([
            'name' => 'Chicken Satay Skewers (3 sticks)',
            'description' => 'Marinated chicken sticks served with homemade peanut sauce and sweet vinegar sauce',
            'price' => 6.99
        ]);
        $this->redirect('/');
    }

    // public function rendered($view, $html)
    // {
    //     // Runs AFTER the provided view is rendered...
    //     $this->dispatch('searchTermUpdated', "meme");
    //     $this ->customerTel = "000000";
    //     // $view: The rendered view
    //     // $html: The final, rendered HTML
    // }

    

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
