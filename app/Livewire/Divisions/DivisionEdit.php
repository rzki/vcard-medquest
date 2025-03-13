<?php

namespace App\Livewire\Divisions;

use Livewire\Component;
use App\Models\Division;
use Livewire\Attributes\Title;

class DivisionEdit extends Component
{
    public $division, $divisionId, $name;
    public function mount($divisionId){
        $division = Division::where('divisionId',$divisionId)->first();
        $this->name = $division->name;
    }
    public function update(){
        Division::where('divisionId', $this->divisionId)->update([
        'name' => $this->name
    ]);
    session()->flash('alert', [
        'type' => 'success',
        'title' => 'Division updated successfully!',
        'toast' => false,
        'position' => 'center',
        'timer' => 1500,
        'progbar' => false,
        'showConfirmButton' => false,
    ]);
    return $this->redirectRoute('divisions.index', navigate:true);

    }
    #[Title('Edit Division')]
    public function render()
    {
        return view('livewire.divisions.division-edit');
    }
}
