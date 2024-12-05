<?php

namespace App\Livewire\Contacts;

use App\Models\Contact;
use Livewire\Component;
use Milon\Barcode\DNS2D;
use Livewire\Attributes\Title;
use JeroenDesloovere\VCard\VCard;
use Illuminate\Support\Facades\Storage;

class ContactEdit extends Component
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
    public function update()
    {
        // vCard data
        $vCard = "BEGIN:VCARD\n";
        $vCard .= "VERSION:3.0\n";
        $vCard .= "N:{$this->last_name};{$this->first_name}\n";
        $vCard .= "FN:{$this->first_name}"." "."{$this->last_name}\n";
        $vCard .= "ORG:PT. Medquest Jaya Global\n";
        $vCard .= "TEL;TYPE=WORK,VOICE:{$this->phone_number}\n";
        $vCard .= "EMAIL:{$this->email}\n";
        $vCard .= "END:VCARD";
        $qr = new DNS2D();
        $qr = base64_decode($qr->getBarcodePNG($vCard, 'QRCODE'));
        $path = 'img/vcard/' . $this->contactId . '.png';
        Storage::disk('public')->put($path, $qr);

        $vcard = new VCard();
        $vcard->addName($this->last_name, $this->first_name);
        $vcard->addEmail($this->email);
        $vcard->addPhoneNumber($this->phone_number);
        $vcard->addCompany('PT. Medquest Jaya Global');
        $file = $vcard->getOutput();
        $pathFile = 'file/vcard/'.$this->first_name.'_'.$this->last_name.'.vcf';
        Storage::disk('public')->put($pathFile, $file);

        Contact::where('contactId', $this->contactId)->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'dept' => $this->dept,
            'barcode' => $path,
            'file' => $pathFile
        ]);

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Contact updated successfully!',
            'toast' => false,
            'position' => 'center',
            'timer' => 1500,
            'progbar' => false,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('contacts.index', navigate:true);
    }

    #[Title('Edit Contact')]
    public function render()
    {
        return view('livewire.contacts.contact-edit');
    }
}
