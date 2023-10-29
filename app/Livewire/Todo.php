<?php

namespace App\Livewire;

use Livewire\Component;

class Todo extends Component
{
    public $teees = "hello";
    public function render()
    {
        return view('livewire.todo');
    }
}
