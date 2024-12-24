<?php

namespace App\Livewire\Divisions;

use Livewire\Component;
use App\Models\Division;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;

class DivisionCreate extends Component
{
    public $name;

    public function create(){
        Division::create([
        'divisionId' => Str::orderedUuid(),
        'name' => $this->name
    ]);
    session()->flash('alert', [
        'type' => 'success',
        'title' => 'Division created successfully!',
        'toast' => false,
        'position' => 'center',
        'timer' => 1500,
        'progbar' => false,
        'showConfirmButton' => false,
    ]);
    return $this->redirectRoute('divisions.index', navigate:true);

    }
    #[Title('Create Division')]
    public function render()
    {
        return view('livewire.divisions.division-create');
    }
}
