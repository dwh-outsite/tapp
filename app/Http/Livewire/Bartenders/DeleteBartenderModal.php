<?php

namespace App\Http\Livewire\Bartenders;

use App\Models\User;
use Livewire\Component;

class DeleteBartenderModal extends Component
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
        return view('bartenders.delete-bartender-modal');
    }
}
