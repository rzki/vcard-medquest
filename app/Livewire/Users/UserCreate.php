<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;

class UserCreate extends Component
{
    public $name, $email, $role;
    public function create()
    {
        $user = User::create([
            'userId' => Str::orderedUuid(),
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make('vCard2024!')
        ]);
        $user->assignRole($this->role);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'User created successfully!',
            'toast' => false,
            'position' => 'center',
            'timer' => 1500,
            'progbar' => false,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('users.index', navigate:true);
    }
    #[Title('Create New User')]
    public function render()
    {
        return view('livewire.users.user-create', [
            'roles' => Role::all()
        ]);
    }
}
