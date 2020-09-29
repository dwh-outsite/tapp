<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class EditUserModal extends Component
{
    public $active = false;
    public ?User $user = null;

    protected $listeners = [
        'edit' => 'handleEdit'
    ];

    protected $rules = [
        'user.name' => ['required', 'string', 'max:255'],
        'user.email' => ['required', 'string', 'email', 'max:255'],
    ];

    public function handleEdit(User $user)
    {
        $this->active = true;
        $this->user = $user;
    }

    public function update()
    {
        $this->validate();

        $this->user->save();

        $this->clearValidation();
        $this->reset();

        $this->emit('updated');
    }

    public function render()
    {
        return view('users.edit-user-modal');
    }
}
