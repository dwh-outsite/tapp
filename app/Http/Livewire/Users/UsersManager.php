<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Jetstream\Jetstream;
use Livewire\Component;

class UsersManager extends Component
{
    protected $listeners = [
        'created' => '$refresh',
        'updated' => '$refresh',
        'deleted' => '$refresh',
    ];

    public function edit(User $user)
    {
        $this->emit('edit', $user);
    }

    public function delete(User $user)
    {
        $this->emit('delete', $user);
    }

    public function downloadIvaCertificate(User $user)
    {
        if ($user->iva_certificate_file) {
            return Storage::download($user->iva_certificate_file);
        }
    }

    public function getUsersProperty()
    {
        return User::all();
    }

    public function render()
    {
        return view('users.users-manager');
    }
}
