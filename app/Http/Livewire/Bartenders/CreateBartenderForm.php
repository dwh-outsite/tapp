<?php

namespace App\Http\Livewire\Bartenders;

use App\Mail\BartenderCreated;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class CreateBartenderForm extends Component
{
    public $name = '';
    public $email = '';

    public $password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'unique:users', 'max:255'],
        'password' => []
    ];

    public function create()
    {
        [$user, $password] = User::createWithRandomPassword($this->validate());

        Mail::to($user)->send(new BartenderCreated($user, $password));

        $this->reset();
        $this->resetValidation();

        $this->emit('created');
    }

    public function render()
    {
        return view('bartenders.create-bartender-form');
    }
}
