<?php

namespace App\Livewire\Contacts;

use App\Models\Contact;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;
use RamonRietdijk\LivewireTables\Livewire\LivewireTable;

class ContactIndex extends Component
{
    public $contact, $contactId;
    public $search, $perPage=5;
    public $selectAll = false, $selectedItems = [];
    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function updatedSelectAll($value)
    {
        if($value)
        {
            $this->selectedItems = Contact::orderByDesc('created_at')->paginate($this->perPage)->pluck('id')->map(fn($id) => (string) $id)->toArray();
        }else{
            $this->selectedItems = [];
        }
    }
    public function updatedSelectedItems()
    {
        // Get the IDs for the current page
        $currentPageIds = Contact::orderByDesc('created_at')->paginate($this->perPage)->pluck('id')->map(fn($id) => (string) $id)->toArray();

        // Check if all items on the current page are selected
        $this->selectAll = !array_diff($currentPageIds, $this->selectedItems) ? true : false;
    }
    public function deleteSelected()
    {
        // Get selected items data
        $itemsToDelete = Contact::whereIn('id', $this->selectedItems)->get();
        foreach ($itemsToDelete as $item)
        {
            Storage::disk('public')->delete($item->barcode);
        }
        // Delete the selected items
        Contact::whereIn('id', $this->selectedItems)->delete();
        // Reset selected items and reload the items
        $this->selectedItems = [];
        session()->flash('alert',  [
            'type' => 'success',
            'title' => 'Selected contact deleted successfully!',
            'toast' => false,
            'position' => 'center',
            'timer' => 1500,
            'progbar' => false,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('contacts.index', navigate: true);
    }
    public function deleteConfirm($contactId)
    {
        $this->contactId = $contactId;
        $this->dispatch('delete-confirmation');
    }
    public function delete()
    {
        $this->contact = Contact::where('contactId', $this->contactId)->first();
        Storage::disk('public')->delete($this->contact->barcode);
        Storage::disk('public')->delete($this->contact->file);
        $this->contact->delete();
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Contact deleted successfully!',
            'toast' => false,
            'position' => 'center',
            'timer' => 1500,
            'progbar' => false,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('contacts.index', navigate: true);
    }

    #[Title('Contacts')]
    public function render()
    {
        return view('livewire.contacts.contact-index', [
            'contacts' => Contact::search($this->search)
                            ->orderByDesc('created_at')
                            ->paginate($this->perPage)
        ]);
    }
}
