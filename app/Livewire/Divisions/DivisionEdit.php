<?php

namespace App\Livewire\Divisions;

use Livewire\Component;
use Livewire\Attributes\Title;

class DivisionEdit extends Component
{
    #[Title('Edit Division')]
    public function render()
    {
        return view('livewire.divisions.division-edit');
    }
}
