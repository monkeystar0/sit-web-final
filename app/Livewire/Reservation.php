<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Rule;
use App\Models\MenuItem;
use App\Models\ReservationItem;
use App\Models\ChosenMenu;
use App\Models\ReservationMenuItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class Reservation extends Component
{
    public $no_persons = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    public $available_time_slots = [];
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
    public $customerNote = '';
    public $menuList = array();
    public $customerInfoDate = '';
    public $chosenMenuList = array();
    public $numberOfMenu = 0;
    public $selectedNoPerson = 1;
    public $currentMenuCat = 1;
    public $totalToPay = 0.0;


    public function render()
    {
        $this->getCustomerInfoProperty();
        return view('livewire.reservation');
    }

    public function mount()
    {
        $this->menuList = MenuItem::where('menu_group', $this->currentMenuCat)->get();
        
    }
    // public function updatedSelectedDate()
    // {
    //     $this->available_time_slots = $this->available_time_slots2;
    // }

    public function setCurrentMenu($catId)
    {
        $this->currentMenuCat = $catId;
        $this->mount();
    }

    public function setMenuCounter()
    {
        $this->numberOfMenu = count($this->chosenMenuList);
        $this->calTotalToPay();
    }

    public function submitReservation()
    {
        //Log::info('updatedSearchTerm was triggered'.json_encode($this->validate()));
        $this->validate();
        // Begin a transaction
        DB::beginTransaction();
        try {
            // Create the reservation
            
            $reservationData = [
                'res_date' => $this->selectedDate,
                'res_time' => $this->selectedTime,
                'cus_name' => $this->reserveName,
                'no_person' => $this->selectedNoPerson,
                'tel' => $this->customerTel,
                'email' => $this->customerEmail,
                'note' => $this->customerNote,
                'no_item' => $this->numberOfMenu,
                'status' => 1
            ];
            $reservation = ReservationItem::create($reservationData);

            // Now let's assume $menuItems is an array of arrays, with each sub-array containing menu item data
            foreach ($this->chosenMenuList as $menuItemData) {
                // Add the reservation ID to the menu item data
                $menuItemData['reservation_id'] = $reservation->id;
                $menuItemData['menu_id'] = $menuItemData['id'];
                // Create the menu item record
                ReservationMenuItem::create($menuItemData);
            }

            // Commit the transaction
            DB::commit();
            //Log::info('updatedSearchTerm was triggered' . json_encode($reservation));
            $this->redirect(route('reserve-confirm',['reservation_id'=>$reservation->id]));
        } catch (\Exception $e) {
            // An error occurred; cancel the transaction
            DB::rollback();

            // And throw the exception again so it can be handled at a higher level
            throw $e;
        }
       
        //config(['front_res.status' => false]);
    }

    // public function updatedReserveName()
    // {
    //     $this->dispatch('searchTermUpdated', $this->selectedDate);
    // }

    public function calTotalToPay()
    {
        $total = collect($this->chosenMenuList)->sum('price');
        $this->totalToPay = $total;
    }

    public function updatedSelectedTime()
    {
        // $this->availableSeat = 'Avaialable seats: 5';
        // $this->dispatch('searchTermUpdated', 'selected' . $this->selectedTime);
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
        //$this->dispatch('searchTermUpdated', $this->selectedDate);
        //check available time slot
        $this->available_time_slots = $this->generateTimeSlots($date);
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
            if ($found_key == 0) {
                array_splice($this->chosenMenuList, 0, 1);
            } else {
                array_splice($this->chosenMenuList, $found_key, $found_key);
                //    $key = $id-1;
                //    unset($this->chosenMenuList[$key]);
            }
        }
        $this->setMenuCounter();
    }

    public function clearAllChosenMenu()
    {
        $this->chosenMenuList = array();
        $this->setMenuCounter();
    }

    function generateTimeSlots($date) {
        $slots = [];
    $operationStartHour = 10; // 10 AM
    $operationEndHour = 18; // 6 PM, last booking at 5 PM
    $currentDateTime = Carbon::now('Pacific/Auckland');
    //Log::info('overall:'.$date);
    $selectedDate = Carbon::createFromFormat('Y-m-d', $date);

    // Check if the selected date is in the future or today
    if ($selectedDate->isToday() || $selectedDate->isFuture()) {
        // If the selected date is today and current time is after operation start, adjust the start hour
        if ($selectedDate->isToday() && $currentDateTime->hour >= $operationStartHour) {
            $operationStartHour = $currentDateTime->hour < ($operationEndHour - 1) ? $currentDateTime->hour + 1 : $operationEndHour;
        }

        // Generate time slots
        for ($hour = $operationStartHour; $hour < $operationEndHour; $hour++) {
            $slots[] = str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00';
        }
    }

    return $slots;
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
