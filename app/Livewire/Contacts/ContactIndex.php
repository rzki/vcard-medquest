<?php

namespace App\Livewire\Contacts;

use Livewire\Component;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;

class ContactIndex extends Component
{
    public function render()
    {
        return view('livewire.contacts.contact-index');
    }
}
