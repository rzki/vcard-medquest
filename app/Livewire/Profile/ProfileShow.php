<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileShow extends Component
{
    public $name, $email, $username;
    #[Validate('nullable|string|confirmed|min:8')]
    public $password;
    public function mount()
    {
        $this->name     = Auth::user()->name;
        $this->email    = Auth::user()->email;
    }
    public function updateProfile()
    {
        if($this->password){
            auth()->user()->update(['password' => Hash::make($this->password)]);
        }

        auth()->user()->update([
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username
        ]);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Profile successfully updated!',
            'toast' => false,
            'position' => 'center',
            'timer' => 1500,
            'progbar' => false,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('myprofile', navigate: true);
    }
    #[Title('My Profile')]
    public function render()
    {
        return view('livewire.profile.profile-show');
    }
}
