<?php

namespace App\Livewire\Contacts;

use Livewire\Attributes\Layout;
use Livewire\Component;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;

class ContactIndex extends Component
{
    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.contacts.contact-index');
    }
}
