<?php

namespace App\Models;

use App\Models\MenuItem;
use stdClass;

class ChosenMenu{

    public $id = '';
    public $name = '';
    public $qty = 0;
    public $price = 0.0;

    // public function toSaveArrayData(){
    //     return ['menu_id' => $this->id, 'name' => $this->name,'qty' => $this->qty,'price' => $this->price];
    // }
    // public $menu = App\Models\MenuItem::class;

}