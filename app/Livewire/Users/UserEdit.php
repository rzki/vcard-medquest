<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserEdit extends Component
{
    public $name, $email, $role;
    public $user, $userId;
    public function mount($userId)
    {
        $this->user = User::where('userId', $userId)->first();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }
    public function update()
    {
        User::where('userId', $this->userId)->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);
        $this->user->assignRole($this->role);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'User updated successfully!',
            'toast' => false,
            'position' => 'center',
            'timer' => 1500,
            'progbar' => false,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('users.index', navigate:true);
    }
    #[Title('Edit User')]
    public function render()
    {
        return view('livewire.users.user-edit', [
            'roles' => Role::all()
        ]);
    }
}
