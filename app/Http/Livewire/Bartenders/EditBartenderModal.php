<?php

namespace App\Http\Livewire\Bartenders;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditBartenderModal extends Component
{
    use WithFileUploads;

    public $active = false;
    public ?User $user = null;

    public $iva_certificate_file;

    protected $listeners = [
        'edit' => 'handleEdit'
    ];

    protected $rules = [
        'user.name' => ['required', 'string', 'max:255'],
        'user.email' => ['required', 'string', 'email', 'max:255'],
        'user.bartending_course' => ['required', 'boolean'],
        'user.bartending_course_date' => ['nullable', 'date'],
        'user.iva_certificate' => ['required', 'boolean'],
        'iva_certificate_file' => ['nullable', 'file', 'mimes:pdf', 'max:10000'],
    ];

    public function handleEdit(User $user)
    {
        $this->active = true;
        $this->user = $user;
    }

    public function update()
    {
        $this->validate();

        if ($this->iva_certificate_file) {
            $this->user->iva_certificate_file = $this->iva_certificate_file->store('iva_certificates');
        }

        $this->user->save();

        $this->clearValidation();
        $this->reset();

        $this->emit('updated');
    }

    public function render()
    {
        return view('bartenders.edit-bartender-modal');
    }
}
