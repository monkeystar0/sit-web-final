<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Rule;
use App\Models\MenuItem;
use App\Models\ChosenMenu;
use Illuminate\Support\Collection;
use stdClass;

class Reservation extends Component
{
    public $no_persons = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    public $available_time_slots = ['09:00', '10:00', '11:00', '12:00', '13:00'];
    public $available_time_slots2 = ['11:00', '12:00', '14:00', '15:00', '16:00'];
    #[Rule('required')]
    public $selectedDate = '';
    #[Rule('required')]
    public $selectedTime = '';
    #[Rule('required')]
    public $reserveName = '';
    #[Rule('required')]
    public $customerTel = "";
    #[Rule('required')]
    public $customerEmail = "";
    public $availableSeat = '';
    public $menuList = array();
    public $customerInfoDate = '';
    public $chosenMenuList = array();
    public $numberOfMenu = 0;


    public function render()
    {
        $this->getCustomerInfoProperty();
        //Log::info('updatedSearchTerm was rendered');
        return view('livewire.reservation');
    }

    public function mount()
    {
        $this->menuList = MenuItem::all();
    }
    // public function updatedSelectedDate()
    // {
    //     $this->available_time_slots = $this->available_time_slots2;
    // }

    public function setMenuCounter(){
        $this->numberOfMenu = count($this->chosenMenuList);
    }

    public function submitReservation()
    {
        //Log::info('updatedSearchTerm was triggered'.json_encode($this->validate()));
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
        $this->dispatch('searchTermUpdated', 'selected' . $this->selectedTime);
    }

    public function getCustomerInfoProperty()
    {
        $dateDisplay = date_create($this->selectedDate);
        $timeDisplay = '';
        if ($this->selectedTime === '') {
            $timeDisplay = '-';
        } else {
            $timeDisplay = $this->selectedTime;
        }
        $this->customerInfoDate = $dateDisplay->format('l jS \o\f F Y') . " at " . $timeDisplay;
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

    public function goBack()
    {
        $this->redirect('/');
    }

    #[On('add-menu-item')]
    public function addMenuItem($id, $qty)
    {
        $result = MenuItem::where('id', $id)->take(1)->get();
        $itemExisted = collect($this->chosenMenuList)->firstWhere('id', $id);
        
        if ($itemExisted !== null && $result !== null) {
            $itemExisted["qty"] += $qty;
            $itemExisted["price"] += ($qty * $result[0]->price);
            $found_key = array_search($id, array_column($this->chosenMenuList, 'id'));
            if ($found_key !== null) {
                $this->chosenMenuList["$found_key"] = $itemExisted;
                // $this->dispatch('searchTermUpdated', $itemExisted);
                // Log::info('add called add exist:'.$found_key.',qty:'.$qty.json_encode($itemExisted));
                // Log::info('overall:'.json_encode($this->chosenMenuList));
            }
        } else {
            $mock = new ChosenMenu;
            $mock->qty = $qty;
            $mock->id = $id;
            $mock->name =  $result[0]->name;
            $mock->price = $qty * $result[0]->price;
            $this->chosenMenuList[] = collect($mock)->toArray();
            // $this->dispatch('searchTermUpdated', $mock);
            // Log::info('add called add new:'.json_encode($mock));
            // Log::info('add called add new:'.json_encode($this->chosenMenuList));
        }
        $this->setMenuCounter();

        // $collection = collect($this->chosenMenuList);
        // $this->dispatch('searchTermUpdated', $collection->toArray());

        
    }

    public function removeChosenMenu($id)
    {
        $found_key = array_search($id, array_column($this->chosenMenuList, 'id'));
        $this->dispatch('searchTermUpdated', $found_key);
        if ($found_key !== null) {
            if ($found_key == 0){
                array_splice($this->chosenMenuList, 0, 1);
            }else{
                array_splice($this->chosenMenuList, $found_key, $found_key);
            //    $key = $id-1;
            //    unset($this->chosenMenuList[$key]);
            }
        }
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
