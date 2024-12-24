<?php

namespace App\Livewire\Contacts;

use App\Models\Contact;
use Livewire\Component;
use App\Models\Division;
use Milon\Barcode\DNS2D;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use JeroenDesloovere\VCard\VCard;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ContactCreate extends Component
{
    public $first_name, $last_name, $email, $phone_number, $phone_number2, $dept, $position, $street, $city, $province, $postcode, $country;

    public function create()
    {
        // vCard data
        $vCard = "BEGIN:VCARD\n";
        $vCard .= "VERSION:3.0\n";
        $vCard .= "N:{$this->last_name};{$this->first_name}\n";
        $vCard .= "FN:{$this->first_name}"." "."{$this->last_name}\n";
        $vCard .= "ADR;TYPE=WORK,PREF:;;{$this->street};{$this->city};{$this->province};{$this->postcode};{$this->country}\n";
        $vCard .= "ORG:PT. Medquest Jaya Global\n";
        $vCard .= "ROLE:{$this->dept}\n";
        $vCard .= "TITLE:{$this->position}\n";
        $vCard .= "TEL;TYPE=MOBILE:{$this->phone_number}\n";
        $vCard .= "TEL;TYPE=WORK:{$this->phone_number2}\n";
        $vCard .= "EMAIL:{$this->email}\n";
        $vCard .= "END:VCARD";
        $uuid = Str::orderedUuid();
        $qr = QrCode::format('png')->size(200)->merge('/public/images/logo/fave-icon_medquest.png', 0.2)->generate(route('contacts.detail', $uuid));
        // $qr = new DNS2D();
        // $qr = base64_decode($qr->getBarcodePNG(route('contacts.detail', $uuid), 'QRCODE'));
        $path = 'img/vcard/' . $uuid . '.png';
        Storage::disk('public')->put($path, $qr);

        $vcard = new VCard();
        $vcard->addName($this->last_name, $this->first_name);
        $vcard->addEmail($this->email);
        $vcard->addAddress(null, null, $this->street, $this->city, $this->province, $this->postcode, $this->country, 'WORK');
        $vcard->addPhoneNumber($this->phone_number);
        $vcard->addPhoneNumber($this->phone_number2);
        $vcard->addCompany('PT. Medquest Jaya Global');
        $vcard->addRole($this->dept);
        $vcard->addJobtitle($this->position);
        $file = $vcard->getOutput();
        $pathFile = 'file/vcard/'.$this->first_name.'_'.$this->last_name.'.vcf';
        Storage::disk('public')->put($pathFile, $file);

        Contact::create([
            'contactId' => $uuid,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'st_address' => $this->street,
            'city_address' => $this->city,
            'province_address' => $this->province,
            'postcode_address' => $this->postcode,
            'country_address' => $this->country,
            'phone_number' => $this->phone_number,
            'phone_number2' => $this->phone_number2 ?? '',
            'dept' => $this->dept,
            'title' => $this->position,
            'barcode' => $path,
            'file' => $pathFile
        ]);

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Contact created successfully!',
            'toast' => false,
            'position' => 'center',
            'timer' => 1500,
            'progbar' => false,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('contacts.index', navigate:true);
    }

    #[Title('Create New Contact')]
    public function render()
    {
        return view('livewire.contacts.contact-create',[
            'divisions' => Division::orderBy('name')->get()
        ]);
    }
}
