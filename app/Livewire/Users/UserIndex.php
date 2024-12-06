<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;

class UserIndex extends Component
{
    public $user, $userId;
    public $search, $perPage=5;
    public $selectAll = false, $selectedItems = [];
    protected $listeners = ['deleteConfirmed' => 'delete'];
    public function deleteConfirm($userId)
    {
        $this->userId = $userId;
        $this->dispatch('delete-confirmation');
    }
    public function delete()
    {
        $this->user = User::where('userId', $this->userId)->first();
        $this->user->delete();
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'User deleted successfully!',
            'toast' => false,
            'position' => 'center',
            'timer' => 1500,
            'progbar' => false,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('users.index', navigate: true);
    }
    #[Title('Users')]
    public function render()
    {
        return view('livewire.users.user-index', [
            'users' => User::search($this->search)
                            ->orderByDesc('created_at')
                            ->paginate($this->perPage)
        ]);
    }
}
