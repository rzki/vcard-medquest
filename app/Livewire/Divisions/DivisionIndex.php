<?php

namespace App\Livewire\Divisions;

use Livewire\Component;
use App\Models\Division;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Storage;

class DivisionIndex extends Component
{
    public $division, $divisionId;
    public $search, $perPage=5;
    public $selectAll = false, $selectedItems = [];
    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function updatedSelectAll($value)
    {
        if($value)
        {
            $this->selectedItems = Division::orderByDesc('created_at')->paginate($this->perPage)->pluck('id')->map(fn($id) => (string) $id)->toArray();
        }else{
            $this->selectedItems = [];
        }
    }
    public function updatedSelectedItems()
    {
        // Get the IDs for the current page
        $currentPageIds = Division::orderByDesc('created_at')->paginate($this->perPage)->pluck('id')->map(fn($id) => (string) $id)->toArray();

        // Check if all items on the current page are selected
        $this->selectAll = !array_diff($currentPageIds, $this->selectedItems) ? true : false;
    }
    public function deleteSelected()
    {
        // Get selected items data
        $itemsToDelete = Division::whereIn('id', $this->selectedItems)->get();
        foreach ($itemsToDelete as $item)
        {
            Storage::disk('public')->delete($item->barcode);
        }
        // Delete the selected items
        Division::whereIn('id', $this->selectedItems)->delete();
        // Reset selected items and reload the items
        $this->selectedItems = [];
        session()->flash('alert',  [
            'type' => 'success',
            'title' => 'Selected division deleted successfully!',
            'toast' => false,
            'position' => 'center',
            'timer' => 1500,
            'progbar' => false,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('divisions.index', navigate: true);
    }
    public function deleteConfirm($divisionId)
    {
        $this->divisionId = $divisionId;
        $this->dispatch('delete-confirmation');
    }
    public function delete()
    {
        $this->division = Division::where('divisionId', $this->divisionId)->first();
        Storage::disk('public')->delete($this->division->barcode);
        Storage::disk('public')->delete($this->division->file);
        $this->division->delete();
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Contact deleted successfully!',
            'toast' => false,
            'position' => 'center',
            'timer' => 1500,
            'progbar' => false,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('divisions.index', navigate: true);
    }

    #[Title('Divisions')]
    public function render()
    {
        return view('livewire.divisions.division-index',[
            'divisions' => Division::search($this->search)
                            ->orderByDesc('created_at')
                            ->paginate($this->perPage)
        ]);
    }
}
