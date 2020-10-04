<?php

namespace App\Http\Livewire\Bartenders;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class BartendersManager extends Component
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
        return view('bartenders.bartenders-manager');
    }
}
