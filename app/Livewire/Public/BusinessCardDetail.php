<?php

namespace App\Livewire\Public;

use App\Models\Contact;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class BusinessCardDetail extends Component
{
    public $contact, $contactId, $first_name, $last_name, $email, $phone_number, $dept;

    public function mount($contactId)
    {
        $this->contact = Contact::where('contactId', $contactId)->first();
        $this->first_name = $this->contact->first_name;
        $this->last_name = $this->contact->last_name;
        $this->email = $this->contact->email;
        $this->phone_number = $this->contact->phone_number;
        $this->dept = $this->contact->dept;
    }
    #[Title('Contact Card Detail')]
    #[Layout('components.layouts.public')]
    public function render()
    {
        return view('livewire.public.business-card-detail');
    }
}
