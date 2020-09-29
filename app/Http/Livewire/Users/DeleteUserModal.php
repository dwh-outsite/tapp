<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class DeleteUserModal extends Component
{
    public $active = false;
    public ?User $user = null;

    protected $listeners = [
        'delete' => 'handleDelete'
    ];

    public function handleDelete(User $user)
    {
        $this->active = true;
        $this->user = $user;
    }

    public function delete()
    {
        $this->user->delete();

        $this->reset();

        $this->emit('deleted');
    }

    public function render()
    {
        return view('users.delete-user-modal');
    }
}
