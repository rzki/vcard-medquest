<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Livewire\Attributes\Title;
use Spatie\Permission\Models\Role;

class RoleCreate extends Component
{
    public $name;
    public function create()
    {
        Role::create([
            'name' => $this->name
        ]);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Role created successfully!',
            'toast'=> false,
            'position'=> 'center',
            'timer'=> 1500,
            'showConfirmButton'=> false
        ]);
        return $this->redirectRoute('roles.index', navigate:true);
    }
    #[Title('Create New Role')]
    public function render()
    {
        return view('livewire.roles.role-create');
    }
}
