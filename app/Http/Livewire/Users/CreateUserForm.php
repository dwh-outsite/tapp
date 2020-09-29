<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateUserForm extends Component
{
    public $name = '';
    public $email = '';

    public $password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => []
    ];

    public function create()
    {
        User::create($this->validate());

        $this->reset();
        $this->resetValidation();

        $this->emit('created');
    }

    public function render()
    {
        return view('users.create-user-form');
    }
}
